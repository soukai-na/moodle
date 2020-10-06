<?php
if (!$_POST["username"]||$_POST["username"]=="Studio") $username="Studio".rand(100,999);
else $username=$_POST["username"];
$username=preg_replace("/[^0-9a-zA-Z]/","-",$username);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VideoWhisper Live Broadcast</title>
</head>
<body bgcolor="#333333">
<?php
$swfurl="live_broadcast.swf?room=" . $username;
$bgcolor="#333333";
?>
<object width="100%" height="100%">
<param name="movie" value="<?=$swfurl?>"></param><param bgcolor="<?=$bgcolor?>"><param name="scale" value="noscale" /> </param><param name="salign" value="lt"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed width="100%" height="100%" scale="noscale" salign="lt" src="<?=$swfurl?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" bgcolor="<?=$bgcolor?>"></embed>
</object>
</body>
</html>
