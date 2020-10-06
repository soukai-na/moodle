<?php
//vs_login.php controls watch interface (video & chat & user list) login called by live_watch.swf
//include("inc.php");
$rtmp_server=$_COOKIE["rtmp_server"];
$rtmp_amf=$_COOKIE["rtmp_amf"];
$tokenKey=$_COOKIE["tokenKey"];
//$username="VW".base_convert((time()-1224350000).rand(0,10),10,36);
$username=$_COOKIE["user_name"];
$room=$_COOKIE["room_name"];

$userType=0;
$visitor=1; //ask for username
if( $username ) $visitor = 0;
//$room=$_GET['room_name'];
	
$msg="";
$loggedin=1;
/*if (in_array($username,$ban_names))
{
	$loggedin=0;
	$msg=urlencode("<a href=\"http://www.videowhisper.com\">You are not allowed to watch Contact for details.</a>");
}

if (in_array($room,$ban_names))
{
	$loggedin=0;
	$msg=urlencode("<a href=\"http://www.videowhisper.com\">This channel was disabled. Contact for details.</a>");
}*/

	
//replace bad words or expression
$filterRegex=$_COOKIE["filterregex"];
$filterReplace=$_COOKIE["filterreplace"];

//fill your layout code between <<<layoutEND and layoutEND;
$layoutCode=$_COOKIE["layoutcode"];
$offlinemessage=$_COOKIE["offlinemessage"];
$welcome=$_COOKIE["welcome2"];
if (!$welcome) $welcome="Welcome on <B>$room</B> live streaming channel!";
$bufferLive=$_COOKIE['bufferLive5'];
$bufferFull=$_COOKIE['bufferFull5'];
$fillWindow=$_COOKIE['fillwindow'];

?>server=<?=$rtmp_server?>&serverAMF=<?=$rtmp_amf?>&tokenKey=<?=$tokenKey?>&bufferLive=<?=$bufferLive?>&bufferFull=<?=$bufferFull?>&welcome=<?=urlencode($welcome)?>&username=<?=$username?>&userType=<?=$userType?>&msg=<?=$msg?>&visitor=<?=$visitor?>&loggedin=<?=$loggedin?>&showCredit=1&disconnectOnTimeout=1&offlineMessage=<?=$offlinemessage?>&disableVideo=<?=$_COOKIE["disablevideo"]?>&disableChat=<?=$_COOKIE["disablechat"]?>&disableUsers=<?=$_COOKIE["disableusers"]?>&layoutCode=<?=urlencode($layoutCode)?>&fillWindow=<?=$fillWindow?>&filterRegex=<?=$filterRegex?>&filterReplace=<?=$filterReplace?>&writeText=<?=$_COOKIE["writetext"]?>&floodProtection=<?=$_COOKIE["floodprotection2"]?>&loadstatus=1