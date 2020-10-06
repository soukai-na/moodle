<?php
//include("inc.php");
$rtmp_server=$_COOKIE["rtmp_server"];
$rtmp_amf=$_COOKIE["rtmp_amf"];
$tokenKey=$_COOKIE["tokenKey"];
//$username="VV".base_convert((time()-1224350000).rand(0,10),10,36);

//$room=$_GET['room_name'];
$username=$_COOKIE["user_name"];
$room=$_COOKIE["room_name"];

$msg="";
$loggedin=1;
/*if (in_array($username,$ban_names))
{
	$loggedin=0;
	$msg=urlencode("<a href=\"http://www.videowhisper.com\">You are not allowed to watch. Contact for details.</a>");
}*/

$offlinemessage=$_COOKIE["offlinemessage"];
$welcome=$_COOKIE["welcome2"];
$bufferLive=$_COOKIE['bufferLive6'];
$bufferFull=$_COOKIE['bufferFull6'];

?>server=<?=$rtmp_server?>&serverAMF=<?=$rtmp_amf?>&tokenKey=<?=$tokenKey?>&bufferLive=<?=$bufferLive?>&bufferFull=<?=$bufferFull?>&welcome=<?=$welcome?>&username=<?=$username?>&userType=0&msg=<?=$msg?>&visitor=1&loggedin=<?=$loggedin?>&showCredit=1&disconnectOnTimeout=1&offlineMessage=<?=$offlinemessage?>&loadstatus=1