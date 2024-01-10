<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Newsletter platform by Angelos Mavros</title>
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
<div class="title">Fetch Database</div>
<br>
<div class="font1">Below are listed all the entries of the database.</div></br>

<?php

include ("../db.php");
fetch_subscribers();

function fetch_subscribers() {
    global $db;
    echo "<font class=\"font3\">";
    echo "<b>---------------------------------------------------------------------------------------------------------------------------------------------------------</b></br>";
    echo "&nbsp;&nbsp; ID &nbsp;&nbsp; | <div style=\"display:inline-block; width:250px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E-mail </div> | &nbsp;&nbsp; Country &nbsp;&nbsp; | &nbsp; Subscribed &nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp; Tester";
    echo "<br>";
    echo "<b>---------------------------------------------------------------------------------------------------------------------------------------------------------</b>";
    $result = $db->sql_query("SELECT * from users");
    while ($row = $db->sql_fetchrow($result)) {
      $user_id = $row['user_id'];
      $tester = $row['tester'];
      if ($tester == 1) { $test3r = "Yes" ; } else {$test3r = "" ; }
      $subscribed = $row['subscribed'];
      if ($subscribed == 1) { $subscrib3d = "Yes" ; } else {$subscrib3d = "No" ; }
      $country = $row['country'];
      $email = $row['email'];
      $status = $row['status'];
        echo "<br></font><font class=\"font2\">";
        echo("<div style=\"display:inline-block; width:35px;\">[". $user_id ."]</div> &nbsp; <div style=\"display:inline-block; width:255px;\"> $email </div> &nbsp; <div style=\"display:inline-block; width:80px;\"> $country &nbsp; </div><div style=\"display:inline-block; width:70px;\">&nbsp;&nbsp;<i> $subscrib3d </i></div> <div style=\"display:inline-block; width:95px;\">&nbsp; $status </div> &nbsp;<i> $test3r </i>");
      }
    echo "</br></br>";
    echo("<br>Fetching completed.</br></br>");
    echo "</font>";
}

?>

<br>
<input type="submit" class="button1" value="Back" style="height:45px; width:140px" onclick="location.href='javascript:history.go(-1)';" >
</br>
</div>
</body>
</html>