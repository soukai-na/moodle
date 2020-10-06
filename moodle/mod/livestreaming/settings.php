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
 * Settings used by the livestreaming module.
 *
 * @package    mod
 * @subpackage livestreaming
 * @copyright  2011 livestreaming
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 **/

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->dirroot.'/mod/livestreaming/locallib.php');

    /** RTMP Server settings */
    $settings->add(new admin_setting_configtext('rtmp_host4', get_string('rtmplabel', 'livestreaming'),
            get_string('rtmpdesc', 'livestreaming'), 'rtmp://localhost/videowhisper', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('rtmp_amf4', get_string('amflabel', 'livestreaming'),
            get_string('amfdesc', 'livestreaming'), 'AMF3', PARAM_TEXT));

    $settings->add(new admin_setting_configtext('tokenKey4', get_string('tokenKeylabel', 'livestreaming'),
            get_string('tokenKeydesc', 'livestreaming'), 'VideoWhisper', PARAM_TEXT));
    /** Video settings */
    $settings->add(new admin_setting_configtext('bufferLive4', get_string('bufferLivelabel', 'livestreaming'),
            get_string('bufferLivedesc', 'livestreaming'), '2', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferFull4', get_string('bufferFulllabel', 'livestreaming'),
            get_string('bufferFulldesc', 'livestreaming'), '16', PARAM_TEXT));
    $settings->add(new admin_setting_configcheckbox('disableBandwidthDetection4', get_string('disableBandwidthDetectionlabel', 'livestreaming'),
            get_string('disableBandwidthDetectiondesc4', 'livestreaming'), '0'));
    $settings->add(new admin_setting_configcheckbox('limitByBandwidth4', get_string('limitByBandwidthlabel', 'livestreaming'),
            get_string('limitByBandwidthdesc', 'livestreaming'), '1'));
    $settings->add(new admin_setting_configcheckbox('generateSnapshots4', get_string('generateSnapshotslabel', 'livestreaming'),
            get_string('generateSnapshotsdesc', 'livestreaming'), 1));			
    $settings->add(new admin_setting_configtext('snapshotsTime4', get_string('snapshotsTimelabel', 'livestreaming'),
            get_string('snapshotsTimedesc', 'livestreaming'), '60000', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferLive5', get_string('bufferLivelabel2', 'livestreaming'),
            get_string('bufferLivedesc2', 'livestreaming'), '0.5', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferFull5', get_string('bufferFulllabel2', 'livestreaming'),
            get_string('bufferFulldesc2', 'livestreaming'), '16', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferLive6', get_string('bufferLivelabel3', 'livestreaming'),
            get_string('bufferLivedesc3', 'livestreaming'), '0.5', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferFull6', get_string('bufferFulllabel3', 'livestreaming'),
            get_string('bufferFulldesc3', 'livestreaming'), '16', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('camMaxBandwidth4', get_string('camMaxBandwidthlabel', 'livestreaming'),
            get_string('camMaxBandwidthdesc', 'livestreaming'), '81920', PARAM_INT));
    $settings->add(new admin_setting_configtext('room_limit4', get_string('room_limitlabel', 'livestreaming'),
            get_string('room_limitdesc', 'livestreaming'), '100', PARAM_INT));
			
			
}