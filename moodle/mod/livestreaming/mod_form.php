<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * The main livestreaming configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package   mod_livestreaming
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_livestreaming_mod_form extends moodleform_mod {

    function definition() {

        global $CFG;
        $mform =& $this->_form;

//-------------------------------------------------------------------------------
    /// Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));

    /// Adding the standard "name" field
        $mform->addElement('text', 'name', get_string('livestreamingroomname', 'livestreaming'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'livestreamingname', 'livestreaming');

        $this->add_intro_editor(true, get_string('desc', 'livestreaming'));

        $mform->addElement('text', 'room_limit', get_string('room_limitlabel', 'livestreaming'), 'onblur="checkmaxroom_limit()"');
        $mform->setDefault('room_limit', $CFG->room_limit4);
        $mform->setType('room_limit', PARAM_INT);

		$mform->addElement('selectyesno', 'open', get_string('open', 'livestreaming'));
		$mform->setDefault('open', '1');

        $mform->addElement('header', 'general', get_string('headersetting', 'livestreaming'));

		$mform->addElement('htmleditor', 'welcome', get_string('welcome', 'livestreaming'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('welcome', "Welcome on <B>$room</B> live streaming channel!");
        $mform->setType('welcome', PARAM_RAW);

		$mform->addElement('selectyesno', 'onlyvideo', get_string('onlyvideo', 'livestreaming'));
		$mform->setDefault('onlyvideo', '0');

		$mform->addElement('selectyesno', 'noembeds', get_string('noembeds', 'livestreaming'));
		$mform->setDefault('noembeds', '0');

        $mform->addElement('text', 'labelcolor', get_string('labelcolor', 'livestreaming'), 'size=52');
        $mform->setDefault('labelcolor', 'FFFFFF');
        $mform->setType('labelcolor', PARAM_TEXT);

        $mform->addElement('text', 'floodprotection', get_string('floodprotection', 'livestreaming'));
        $mform->setDefault('floodprotection', '1');
        $mform->setType('floodprotection', PARAM_INT);

		$mform->addElement('selectyesno', 'showtimer', get_string('showtimer', 'livestreaming'));
		$mform->setDefault('showtimer', '0');

        $mform->addElement('text', 'camwidth', get_string('camWidth', 'livestreaming'));
        $mform->setDefault('camwidth', '320');
        $mform->setType('camwidth', PARAM_INT);

        $mform->addElement('text', 'camheight', get_string('camHeight', 'livestreaming'));
        $mform->setDefault('camheight', '240');
        $mform->setType('camheight', PARAM_INT);

        $mform->addElement('text', 'camfps', get_string('camFPS', 'livestreaming'));
        $mform->setDefault('camfps', '15');
        $mform->setType('camfps', PARAM_INT);

        $options=array();
        $options[11]   =  11;
        $options[22]   =  22;
        $options[44]    =  44;
        $options[48]    =  48;
        $mform->addElement('select', 'micrate', get_string('micRate', 'livestreaming'), $options);
		$mform->setDefault('micrate', '11');
		
?>
<script type="text/javascript">
function checkmaxbandwidth() {
	var maxcambandwidth = <?php echo $CFG->camMaxBandwidth4;?>;
	var cambandwidth = document.getElementById('id_cambandwidth');

	if (cambandwidth.value > maxcambandwidth) {
		alert('Max camera bandwidth is '+maxcambandwidth);
		cambandwidth.value = maxcambandwidth;
		cambandwidth.focus();
	} 
}
function checkmaxbandwidth2() {
	var maxcambandwidth = <?php echo $CFG->camMaxBandwidth4;?>;
	var cambandwidth = document.getElementById('id_cammaxbandwidth');

	if (cambandwidth.value > maxcambandwidth) {
		alert('Max camera bandwidth is '+maxcambandwidth);
		cambandwidth.value = maxcambandwidth;
		cambandwidth.focus();
	} 
}
function checkmaxroom_limit() {
	var maxroom_limit = <?php echo $CFG->room_limit4;?>;
	var room_limit = document.getElementById('id_room_limit');

	if (room_limit.value > maxroom_limit) {
		alert('Max room_limit is '+maxroom_limit);
		room_limit.value = maxroom_limit;
		room_limit.focus();
	} 
}
</script>
<?php		
		
        $mform->addElement('text', 'cambandwidth', get_string('camBandwidthlabel', 'livestreaming'), 'onblur="checkmaxbandwidth()"');
        $mform->setDefault('cambandwidth', '40960');
        $mform->setType('cambandwidth', PARAM_INT);

        $mform->addElement('text', 'cammaxbandwidth', get_string('camMaxBandwidthlabel', 'livestreaming'), 'onblur="checkmaxbandwidth2()"');
        $mform->setDefault('cammaxbandwidth', '81920');
        $mform->setType('cammaxbandwidth', PARAM_INT);

        $mform->addElement('header', 'general', get_string('headersetting2', 'livestreaming'));

		$mform->addElement('htmleditor', 'welcome2', get_string('welcome', 'livestreaming'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('welcome2', "Welcome on <B>$room</B> live streaming channel!");
        $mform->setType('welcome2', PARAM_RAW);

        $mform->addElement('text', 'offlinemessage', get_string('offlinemessage', 'livestreaming'), 'size=52');
        $mform->setDefault('offlinemessage', 'Channel+Offline');
        $mform->setType('offlinemessage', PARAM_TEXT);

		$mform->addElement('textarea', 'layoutcode', get_string('layoutCode', 'livestreaming'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('layoutcode', "");
        $mform->setType('layoutcode', PARAM_RAW);

		$mform->addElement('selectyesno', 'fillwindow', get_string('fillWindow', 'livestreaming'));
		$mform->setDefault('fillwindow', '0');

        $mform->addElement('text', 'filterregex', get_string('filterRegex', 'livestreaming'), 'size=52');
        $mform->setDefault('filterregex', '(?i)(fuck|cunt)(?-i)');
        $mform->setType('filterregex', PARAM_TEXT);

        $mform->addElement('text', 'filterreplace', get_string('filterReplace', 'livestreaming'), 'size=52');
        $mform->setDefault('filterreplace', ' ** ');
        $mform->setType('filterreplace', PARAM_TEXT);

        $mform->addElement('text', 'floodprotection2', get_string('floodprotection', 'livestreaming'));
        $mform->setDefault('floodprotection2', '3');
        $mform->setType('floodprotection2', PARAM_INT);
				
		$mform->addElement('selectyesno', 'guestwatch', get_string('guestwatch', 'livestreaming'));
		$mform->setDefault('guestwatch', '1');

		$mform->addElement('selectyesno', 'guestvideo', get_string('guestvideo', 'livestreaming'));
		$mform->setDefault('guestvideo', '1');
		// add standard elements, common to all modules
        $this->standard_coursemodule_elements();
//-------------------------------------------------------------------------------
        // add standard buttons, common to all modules
        $this->add_action_buttons();
    }
}
