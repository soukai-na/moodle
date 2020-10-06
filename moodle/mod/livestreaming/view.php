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
 * Prints a particular instance of livestreaming
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package   mod_livestreaming
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/// (Replace livestreaming with the name of your module and remove this line)

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // livestreaming instance ID - it should be named as the first character of the module
$video  = optional_param('video', 0, PARAM_INT);  // livestreaming instance ID - it should be named as the first character of the module
//echo "======== ".$video;
if ($id) {
	$cm         = get_coursemodule_from_id('livestreaming', $id, 0, false, MUST_EXIST);
	$course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
	$livestreaming  = $DB->get_record('livestreaming', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
	$livestreaming  = $DB->get_record('livestreaming', array('id' => $n), '*', MUST_EXIST);
	$course     = $DB->get_record('course', array('id' => $livestreaming->course), '*', MUST_EXIST);
	$cm         = get_coursemodule_from_instance('livestreaming', $livestreaming->id, $course->id, false, MUST_EXIST);
} else {
	error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);
$context = get_context_instance(CONTEXT_MODULE, $cm->id);
$PAGE->set_context($context);

if ($video == 0) {

	/// Print the page header
	add_to_log($course->id, 'livestreaming', 'view', "view.php?id=$cm->id", $livestreaming->name, $cm->id);

	$PAGE->set_url('/mod/livestreaming/view.php', array('id' => $cm->id));
	$accessdata = get_user_access_sitewide($_SESSION['USER']->id);
	$PAGE->set_title($course->fullname.': '.get_string('moduletitle', 'livestreaming'));
	$PAGE->set_heading($course->shortname);
	$PAGE->set_button(update_module_button($cm->id, $course->id, get_string('modulename', 'livestreaming')));

	// other things you may want to set - remove if not needed
	//$PAGE->set_cacheable(false);
	//$PAGE->set_focuscontrol('some-html-id');

	// Output starts here
	echo $OUTPUT->header();
//echo "-------------" ;
	if ($livestreaming->open == '1') {
		// Replace the following lines with you own code
		//echo $OUTPUT->heading('Video Consultation room name '.$livestreaming->name.$course->shortname.$id.', '.$USER->id.', '.$USER->username);
		echo $OUTPUT->heading($livestreaming->name);

		if ($livestreaming->intro) {
			echo $OUTPUT->box(format_module_intro('livestreaming', $livestreaming, $cm->id), 'generalbox', 'intro');
		}
		/// Print the main part of the page
		if (has_capability('mod/livestreaming:view2', $context)) {
			echo $OUTPUT->box_start('generalbox', 'enterlink');
			$params['id'] = $id;
			$params['video'] = '1';
			$link = new moodle_url('/mod/livestreaming/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center">';
			echo $OUTPUT->action_link($link, get_string('broadcast', 'livestreaming'), $action, array('title'=>get_string('modulename', 'livestreaming')));
			echo '</h2>';
			//echo $OUTPUT->box_end();
		}
		if (has_capability('mod/livestreaming:view', $context)) {
			//echo $OUTPUT->box_start('generalbox', 'enterlink');
			$params['id'] = $id;
			$params['video'] = '2';
			$link = new moodle_url('/mod/livestreaming/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center">';
			echo $OUTPUT->action_link($link, get_string('watch', 'livestreaming'), $action, array('title'=>get_string('modulename', 'livestreaming')));
			echo '</h2>';
			$params['id'] = $id;
			$params['video'] = '3';
			$link = new moodle_url('/mod/livestreaming/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center">';
			echo $OUTPUT->action_link($link, get_string('video', 'livestreaming'), $action, array('title'=>get_string('modulename', 'livestreaming')));
			echo '</h2><p>Clicking link above should open application in a new window. If application does not open, disable popup blockers for this site or right click and open in new tab.</p>';
			echo $OUTPUT->box_end();
		}
		if ($USER->username == 'guest') {
			echo $OUTPUT->box_start('generalbox', 'enterlink');
			$params['id'] = $id;
			$params['video'] = '2';
			$link = new moodle_url('/mod/livestreaming/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center">';
			echo $OUTPUT->action_link($link, get_string('watch', 'livestreaming'), $action, array('title'=>get_string('modulename', 'livestreaming')));
			echo '</h2>';
			$params['id'] = $id;
			$params['video'] = '3';
			$link = new moodle_url('/mod/livestreaming/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center">';
			echo $OUTPUT->action_link($link, get_string('video', 'livestreaming'), $action, array('title'=>get_string('modulename', 'livestreaming')));
			echo '</h2><p>Clicking link above should open application in a new window. If application does not open, disable popup blockers for this site or right click and open in new tab.</p>';
			echo $OUTPUT->box_end();
		}
	} else {
		echo $OUTPUT->box_start('generalbox', 'notallowenter');
		echo '<p>'.get_string('notallowenter', 'livestreaming').'</p>';
		echo $OUTPUT->box_end();
	}

	// Finish the page
	echo $OUTPUT->footer();
} elseif ($video == 1) {
	
	$rtmp_server = $CFG->rtmp_host4;
	$rtmp_amf = $CFG->rtmp_amf4;
	$tokenKey = $CFG->tokenKey4;

	$username = preg_replace("/[^0-9a-zA-Z]/","-", $USER->username);
	$r = preg_replace("/[^0-9a-zA-Z]/","-", $livestreaming->name);
	
	setcookie("user_name",$username,time()+86400);
	setcookie("room_name",$r,time()+86400);
	setcookie("rtmp_server",$rtmp_server,time()+86400);
	setcookie("rtmp_amf",$rtmp_amf,time()+86400);
	setcookie("tokenKey",$tokenKey,time()+86400);
	setcookie("camMaxBandwidth",$livestreaming->cammaxbandwidth,time()+86400);
	setcookie("bufferLive4",$CFG->bufferLive4,time()+86400);
	setcookie("bufferFull4",$CFG->bufferFull4,time()+86400);
	setcookie("bufferLive5",$CFG->bufferLive5,time()+86400);
	setcookie("bufferFull5",$CFG->bufferFull5,time()+86400);
	setcookie("bufferLive6",$CFG->bufferLive6,time()+86400);
	setcookie("bufferFull6",$CFG->bufferFull6,time()+86400);
	setcookie("snapshotsTime",$CFG->snapshotsTime,time()+86400);
	setcookie("disableBandwidthDetection",'0',time()+86400);
	if ($CFG->disableBandwidthDetection != '0') setcookie("disableBandwidthDetection",'1',time()+86400);
	setcookie("limitByBandwidth",'0',time()+86400);
	if ($CFG->limitByBandwidth != '0') setcookie("limitByBandwidth",'1',time()+86400);
	setcookie("generateSnapshots",'0',time()+86400);
	if ($CFG->generateSnapshots != '0') setcookie("generateSnapshots",'1',time()+86400);

	setcookie("camWidth",$livestreaming->camwidth,time()+86400);
	setcookie("camHeight",$livestreaming->camheight,time()+86400);
	setcookie("camFPS",$livestreaming->camfps,time()+86400);
	setcookie("micRate",$livestreaming->micrate,time()+86400);
	setcookie("camBandwidth",$livestreaming->cambandwidth,time()+86400);
	setcookie("welcome",$livestreaming->welcome,time()+86400);
	setcookie("labelcolor",$livestreaming->labelcolor,time()+86400);
	setcookie("onlyvideo",$livestreaming->onlyvideo,time()+86400);
	setcookie("noembeds",$livestreaming->noembeds,time()+86400);
	setcookie("showtimer",$livestreaming->showtimer,time()+86400);
	setcookie("floodprotection",$livestreaming->floodprotection,time()+86400);
	setcookie("room_limit",$livestreaming->room_limit,time()+86400);
	if (has_capability('mod/livestreaming:write_text', $context)) {
		setcookie("writetext",'1',time()+86400);
	} else {
		setcookie("writetext",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:advancedcamsettings', $context)) {
		setcookie("advancedCamSettings",'1',time()+86400);
	} else {
		setcookie("advancedCamSettings",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:configuresource', $context)) {
		setcookie("configureSource",'1',time()+86400);
	} else {
		setcookie("configureSource",'0',time()+86400);
	}

	setcookie("welcome2",$livestreaming->welcome2,time()+86400);
	setcookie("offlinemessage",$livestreaming->offlinemessage,time()+86400);
	setcookie("layoutcode",$livestreaming->layoutcode,time()+86400);
	setcookie("fillwindow",$livestreaming->fillwindow,time()+86400);
	setcookie("filterregex",$livestreaming->filterregex,time()+86400);
	setcookie("filterreplace",$livestreaming->filterreplace,time()+86400);
	setcookie("floodprotection2",$livestreaming->floodprotection2,time()+86400);
	//echo "-------------".has_capability('mod/livestreaming:write_text', $context);
	if (has_capability('mod/livestreaming:write_text', $context)) {
		setcookie("writetext2",'1',time()+86400);
	} else {
	
		setcookie("writetext2",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:disablevideo', $context)) {
		setcookie("disablevideo",'0',time()+86400);
	} else {
		setcookie("disablevideo",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disablechat', $context)) {
		setcookie("disablechat",'0',time()+86400);
	} else {
		setcookie("disablechat",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disableusers', $context)) {
		setcookie("disableusers",'0',time()+86400);
	} else {
		setcookie("disableusers",'1',time()+86400);
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VideoWhisper Live Broadcast</title>
</head>
<body bgcolor="#333333">
<?php
$swfurl="live_broadcast.swf";
$bgcolor="#333333";
?>
<object width="100%" height="100%">
<param name="movie" value="<?=$swfurl?>"></param><param bgcolor="<?=$bgcolor?>"><param name="scale" value="noscale" /> </param><param name="salign" value="lt"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed width="100%" height="100%" scale="noscale" salign="lt" src="<?=$swfurl?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" bgcolor="<?=$bgcolor?>"></embed>
</object>
</body>
</html>

<?php
} elseif ($video == 2) {
	$rtmp_server = $CFG->rtmp_host4;
	$rtmp_amf = $CFG->rtmp_amf4;
	$tokenKey = $CFG->tokenKey4;

	$username = preg_replace("/[^0-9a-zA-Z]/","-", $USER->username);
	$r = preg_replace("/[^0-9a-zA-Z]/","-", $livestreaming->name);
	
	setcookie("user_name",$username,time()+86400);
	setcookie("room_name",$r,time()+86400);
	setcookie("rtmp_server",$rtmp_server,time()+86400);
	setcookie("rtmp_amf",$rtmp_amf,time()+86400);
	setcookie("tokenKey",$tokenKey,time()+86400);
	setcookie("camMaxBandwidth",$livestreaming->cammaxbandwidth,time()+86400);
	setcookie("bufferLive4",$CFG->bufferLive4,time()+86400);
	setcookie("bufferFull4",$CFG->bufferFull4,time()+86400);
	setcookie("bufferLive5",$CFG->bufferLive5,time()+86400);
	setcookie("bufferFull5",$CFG->bufferFull5,time()+86400);
	setcookie("bufferLive6",$CFG->bufferLive6,time()+86400);
	setcookie("bufferFull6",$CFG->bufferFull6,time()+86400);
	setcookie("snapshotsTime",$CFG->snapshotsTime,time()+86400);
	setcookie("disableBandwidthDetection",'0',time()+86400);
	if ($CFG->disableBandwidthDetection != '0') setcookie("disableBandwidthDetection",'1',time()+86400);
	setcookie("limitByBandwidth",'0',time()+86400);
	if ($CFG->limitByBandwidth != '0') setcookie("limitByBandwidth",'1',time()+86400);
	setcookie("generateSnapshots",'0',time()+86400);
	if ($CFG->generateSnapshots != '0') setcookie("generateSnapshots",'1',time()+86400);

	setcookie("camWidth",$livestreaming->camwidth,time()+86400);
	setcookie("camHeight",$livestreaming->camheight,time()+86400);
	setcookie("camFPS",$livestreaming->camfps,time()+86400);
	setcookie("micRate",$livestreaming->micrate,time()+86400);
	setcookie("camBandwidth",$livestreaming->cambandwidth,time()+86400);
	setcookie("welcome",$livestreaming->welcome,time()+86400);
	setcookie("labelcolor",$livestreaming->labelcolor,time()+86400);
	setcookie("onlyvideo",$livestreaming->onlyvideo,time()+86400);
	setcookie("noembeds",$livestreaming->noembeds,time()+86400);
	setcookie("showtimer",$livestreaming->showtimer,time()+86400);
	setcookie("floodprotection",$livestreaming->floodprotection,time()+86400);
	setcookie("room_limit",$livestreaming->room_limit,time()+86400);
	//echo ".......".has_capability('mod/livestreaming:write_text', $context);
	//if (has_capability('mod/livestreaming:write_text', $context)) {
	if ( 1 ) {
		setcookie("writetext",'1',time()+86400);
	} else {
		setcookie("writetext",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:advancedcamsettings', $context)) {
		setcookie("advancedCamSettings",'1',time()+86400);
	} else {
		setcookie("advancedCamSettings",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:configuresource', $context)) {
		setcookie("configureSource",'1',time()+86400);
	} else {
		setcookie("configureSource",'0',time()+86400);
	}

	setcookie("welcome2",$livestreaming->welcome2,time()+86400);
	setcookie("offlinemessage",$livestreaming->offlinemessage,time()+86400);
	setcookie("layoutcode",$livestreaming->layoutcode,time()+86400);
	setcookie("fillwindow",$livestreaming->fillwindow,time()+86400);
	setcookie("filterregex",$livestreaming->filterregex,time()+86400);
	setcookie("filterreplace",$livestreaming->filterreplace,time()+86400);
	setcookie("floodprotection2",$livestreaming->floodprotection2,time()+86400);
	//echo ".......".has_capability('mod/livestreaming:write_text', $context);
	//echo " //////////".has_capability('mod/livestreaming:write_text', $context);
	/*if (has_capability('mod/livestreaming:write_text', $context)) {
		setcookie("writetext2",'1',time()+86400);
	} else {
		setcookie("writetext2",'0',time()+86400);
	}*/
	if (has_capability('mod/livestreaming:disablevideo', $context)) {
		setcookie("disablevideo",'0',time()+86400);
	} else {
		setcookie("disablevideo",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disablechat', $context)) {
		setcookie("disablechat",'0',time()+86400);
	} else {
		setcookie("disablechat",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disableusers', $context)) {
		setcookie("disableusers",'0',time()+86400);
	} else {
		setcookie("disableusers",'1',time()+86400);
	}
	$n=$r;

$swfurl="live_watch.swf?n=".urlencode($n);
?>
<head>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	background-color: #000;
	font-size: 15px;
	color: #EEE;
}

a
{
	color: #FF6699;
	font-weight: normal;
	text-decoration: none;
}
-->
</style><title><?=$n?> Live Video Streaming</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" bgcolor="#000000"><p><strong>You are watching:
        <?=strip_tags($n)?>
        </strong><br>
        Channel Demo Page - Edit channel.php to change this</p>
      <p><strong><br />
      </strong></p></td>
  </tr>
  <tr>
    <td height=400 bgcolor="#333333">
	
	<object width="100%" height="100%">
      <param name="movie" value="<?=$swfurl?>"></param><param name="scale" value="noscale" /><param name="salign" value="lt"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed width="100%" height="100%" scale="noscale" salign="lt" src="<?=$swfurl?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>
    </object>
	
	</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#000000"><p>&nbsp;</p>
      <p><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">You can also embed just <a href="video.php?n=<?=$n?>">plain video</a>. The flash workspace above can have any size. Any of the panels can be disabled from vs_login.php .</font>      </p>
      <p><a href="http://www.videowhisper.com/?p=Live+Streaming">Video Whisper Live Streaming</a></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
} else {
	$rtmp_server = $CFG->rtmp_host4;
	$rtmp_amf = $CFG->rtmp_amf4;
	$tokenKey = $CFG->tokenKey4;

	$username = preg_replace("/[^0-9a-zA-Z]/","-", $USER->username);
	$r = preg_replace("/[^0-9a-zA-Z]/","-", $livestreaming->name);
	
	setcookie("user_name",$username,time()+86400);
	setcookie("room_name",$r,time()+86400);
	setcookie("rtmp_server",$rtmp_server,time()+86400);
	setcookie("rtmp_amf",$rtmp_amf,time()+86400);
	setcookie("tokenKey",$tokenKey,time()+86400);
	setcookie("camMaxBandwidth",$livestreaming->cammaxbandwidth,time()+86400);
	setcookie("bufferLive4",$CFG->bufferLive4,time()+86400);
	setcookie("bufferFull4",$CFG->bufferFull4,time()+86400);
	setcookie("bufferLive5",$CFG->bufferLive5,time()+86400);
	setcookie("bufferFull5",$CFG->bufferFull5,time()+86400);
	setcookie("bufferLive6",$CFG->bufferLive6,time()+86400);
	setcookie("bufferFull6",$CFG->bufferFull6,time()+86400);
	setcookie("snapshotsTime",$CFG->snapshotsTime,time()+86400);
	setcookie("disableBandwidthDetection",'0',time()+86400);
	if ($CFG->disableBandwidthDetection != '0') setcookie("disableBandwidthDetection",'1',time()+86400);
	setcookie("limitByBandwidth",'0',time()+86400);
	if ($CFG->limitByBandwidth != '0') setcookie("limitByBandwidth",'1',time()+86400);
	setcookie("generateSnapshots",'0',time()+86400);
	if ($CFG->generateSnapshots != '0') setcookie("generateSnapshots",'1',time()+86400);

	setcookie("camWidth",$livestreaming->camwidth,time()+86400);
	setcookie("camHeight",$livestreaming->camheight,time()+86400);
	setcookie("camFPS",$livestreaming->camfps,time()+86400);
	setcookie("micRate",$livestreaming->micrate,time()+86400);
	setcookie("camBandwidth",$livestreaming->cambandwidth,time()+86400);
	setcookie("welcome",$livestreaming->welcome,time()+86400);
	setcookie("labelcolor",$livestreaming->labelcolor,time()+86400);
	setcookie("onlyvideo",$livestreaming->onlyvideo,time()+86400);
	setcookie("noembeds",$livestreaming->noembeds,time()+86400);
	setcookie("showtimer",$livestreaming->showtimer,time()+86400);
	setcookie("floodprotection",$livestreaming->floodprotection,time()+86400);
	setcookie("room_limit",$livestreaming->room_limit,time()+86400);
	if (has_capability('mod/livestreaming:write_text', $context)) {
		setcookie("writetext",'1',time()+86400);
	} else {
		setcookie("writetext",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:advancedcamsettings', $context)) {
		setcookie("advancedCamSettings",'1',time()+86400);
	} else {
		setcookie("advancedCamSettings",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:configuresource', $context)) {
		setcookie("configureSource",'1',time()+86400);
	} else {
		setcookie("configureSource",'0',time()+86400);
	}

	setcookie("welcome2",$livestreaming->welcome2,time()+86400);
	setcookie("offlinemessage",$livestreaming->offlinemessage,time()+86400);
	setcookie("layoutcode",$livestreaming->layoutcode,time()+86400);
	setcookie("fillwindow",$livestreaming->fillwindow,time()+86400);
	setcookie("filterregex",$livestreaming->filterregex,time()+86400);
	setcookie("filterreplace",$livestreaming->filterreplace,time()+86400);
	setcookie("floodprotection2",$livestreaming->floodprotection2,time()+86400);
	if (has_capability('mod/livestreaming:write_text', $context)) {
		setcookie("writetext2",'1',time()+86400);
	} else {
		setcookie("writetext2",'0',time()+86400);
	}
	if (has_capability('mod/livestreaming:disablevideo', $context)) {
		setcookie("disablevideo",'0',time()+86400);
	} else {
		setcookie("disablevideo",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disablechat', $context)) {
		setcookie("disablechat",'0',time()+86400);
	} else {
		setcookie("disablechat",'1',time()+86400);
	}
	if (has_capability('mod/livestreaming:disableusers', $context)) {
		setcookie("disableusers",'0',time()+86400);
	} else {
		setcookie("disableusers",'1',time()+86400);
	}

	$n=$r;

$swfurl="live_video.swf?n=".urlencode($n);
$scale="noborder";
?>
<head>
<style type="text/css">
<!--
body {
	background-color: #000;
}
-->
</style>
<title><?=$n?> Live Video Streaming</title>
</head>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"> 

<div id="videowhisper_video">
<object width="100%" height="100%">
<param name="movie" value="<?=$swfurl?>"></param><param name="scale" value="<?=$scale?>" /><param name="salign" value="lt"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed width="100%" height="100%" scale="<?=$scale?>" salign="lt" src="<?=$swfurl?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>
</object>
</div>

</body>
<?php
}