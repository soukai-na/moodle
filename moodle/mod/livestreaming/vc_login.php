<?php
//This script controls login and parameters to broadcasting inteface (is called by live_broadcast.swf)
//include("inc.php");
$rtmp_server=$_COOKIE["rtmp_server"];
$rtmp_amf=$_COOKIE["rtmp_amf"];
$tokenKey=$_COOKIE["tokenKey"];
$username=$_COOKIE["user_name"];
$room_name=$_COOKIE["room_name"];
$username=$room_name;
$username=preg_replace("/[^0-9a-zA-Z_]/","-",$username);

$msg="";
$loggedin=1;
/*if (in_array($username,$ban_names))
{
	$loggedin=0;
	$msg=urlencode("<a href=\"http://www.videowhisper.com\">You are not allowed to broadcast. Contact for details.</a>");
}*/

function baseURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }

 return substr($pageURL,0,strrpos($pageURL,"/"))."/";
}

$base=baseURL();
$linkcode=$base."channel.php?n=".urlencode($room_name);
$imagecode=$base."snapshots/".urlencode($room_name).".jpg";
$swfurl=$base."live_watch.swf?n=".urlencode($room_name);
$swfurl2=$base."live_video.swf?n=".urlencode($room_name);

$embedcode =<<<EMBEDEND
<object width="640" height="350"><param name="movie" value="$swfurl" /><param name="base" value="$base" /><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="scale" value="noscale" /><param name="salign" value="lt" /><embed src="$swfurl" base="$base" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="350" scale="noscale" salign="lt"></embed></object>
EMBEDEND;
$embedvcode =<<<EMBEDEND2
<object width="320" height="240"><param name="movie" value="$swfurl2" /><param name="base" value="$base" /><param name="scale" value="exactfit"/><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /><embed src="$swfurl2" base="$base" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="240" scale="exactfit"></embed></object>
EMBEDEND2;

$camWidth=$_COOKIE['camWidth'];
$camHeight=$_COOKIE['camHeight'];
$camFPS=$_COOKIE['camFPS'];
$micRate=$_COOKIE['micRate'];
$camBandwidth=$_COOKIE['camBandwidth'];
$camMaxBandwidth=$_COOKIE['camMaxBandwidth'];
$bufferLive=$_COOKIE['bufferLive4'];
$bufferFull=$_COOKIE['bufferFull4'];
$disableBandwidthDetection=$_COOKIE['disableBandwidthDetection'];
$limitByBandwidth=$_COOKIE['limitByBandwidth'];

$room_limit=$_COOKIE["room_limit"];
$welcome=$_COOKIE["welcome"];

?>server=<?=$rtmp_server?>&serverAMF=<?=$rtmp_amf?>&tokenKey=<?=$tokenKey?>&room=<?=$room_name?>&welcome=<?=$welcome?>&username=<?=$username?>&userType=3&webserver=&msg=<?=$msg?>&loggedin=<?=$loggedin?>&linkcode=<?=urlencode($linkcode)?>&embedcode=<?=urlencode($embedcode)?>&embedvcode=<?=urlencode($embedvcode)?>&imagecode=<?=urlencode($imagecode)?>&room_limit=<?=$room_limit?>&showTimer=<?=$_COOKIE["showtimer"]?>&showCredit=1&disconnectOnTimeout=1&showCamSettings=1&advancedCamSettings=<?=$_COOKIE["advancedCamSettings"]?>&configureSource=<?=$_COOKIE["configureSource"]?>&generateSnapshots=<?=$_COOKIE["generateSnapshots"]?>&snapshotsTime=<?=$_COOKIE["snapshotsTime"]?>&onlyVideo=<?=$_COOKIE["onlyvideo"]?>&noVideo=0&noEmbeds=<?=$_COOKIE["noembeds"]?>&labelColor=<?=$_COOKIE["labelcolor"]?>&writeText=<?=$_COOKIE["writetext"]?>&floodProtection=<?=$_COOKIE["floodprotection"]?>&loadstatus=1&camWidth=<?=$camWidth?>&camHeight=<?=$camHeight?>&camFPS=<?=$camFPS?>&micRate=<?=$micRate?>&camBandwidth=<?=$camBandwidth?>&camMaxBandwidth=<?=$camMaxBandwidth?>&bufferLive=<?=$bufferLive?>&bufferFull=<?=$bufferFull?>&disableBandwidthDetection=<?=$disableBandwidthDetection?>&limitByBandwidth=<?=$limitByBandwidth?>