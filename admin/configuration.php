<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Newsletter system by Angelos Mavros</title>
<meta name="robots" content="noydir">
<meta name="robots" content="noodp">
<LINK REL="SHORTCUT ICON" HREF="../favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
<br></br>
<center>
<div class="form1">
<div class="title">System Configuration</div>

<?php

include ("../db.php");

function read() {
    $content = file_get_contents("../config.php");
    echo ""
    ."<font class=\"font1\">"
    ."<form method=\"post\" action=\"configuration.php\">"
    ."<br></br><textarea style=\"resize: none\" class=\"input_box\" name=\"content\" cols=\"74\" rows=\"21\">$content</textarea>"
    ."<br><br></br>"
    ."<input type=\"hidden\" name=\"op\" value=\"save\"></input></input>"
    ."<input class=\"button1\" type=\"submit\" style=\"height:45px; width:145px\" value=\"Save\">"
    ."&nbsp;&nbsp;<input class=\"button1\" value=\"        Back\" style=\"height:45px; width:145px\" onclick=\"location.href='javascript:history.go(-1)';\" >"
    ."</form>";
}

function save($content) {
	$fp = fopen("../config.php", "w");
    ftruncate($fp, 0);
    fwrite($fp, $content);
    fclose($fp);
	echo "<br></br><font class=\"font2\"><i>Configuration saved.</i></font></br>";
    echo "<br></br><input class=\"button1\" value=\"    Main Menu\" style=\"height:45px; width:153px\" onclick=\"location.href='index.php';\"></br>";
}

switch ($op) {
    case "read":
    read();
    break;
    case "save":
    save($content);
    break;
}
?>

</div>
</body>
</html>