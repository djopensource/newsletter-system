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
<div class="title">Administration</div>
<br><div class="font1">Newsletter system version 1.0 by Angelos Mavros based on php / mysql.</div></br>

<?php
echo ""
    ."<table width=\"550\" cellspacing=\"2\" cellpadding=\"8\" border=\"0\">"
      ."<tbody>"
        ."<tr>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Send Newsletter\" style=\"height:55px; width:285px\" onclick=\"location.href='newsletter.php?op=compose';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Add Addresses\" style=\"height:55px; width:285px\" onclick=\"location.href='upload.php';\">"
          ."</td>"
        ."</tr>"



        ."<tr>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Purge Bounced\" style=\"height:55px; width:285px\" onclick=\"location.href='bounced.php';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Statistics\" style=\"height:55px; width:285px\" onclick=\"location.href='statistics.php';\">"
          ."</td>"
        ."</tr>"

        ."<tr>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Log File\" style=\"height:55px; width:285px\" onclick=\"location.href='log.htm';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Configuration File\" style=\"height:55px; width:285px\" onclick=\"location.href='configuration.php?op=read'\" \">"
          ."</td>"
        ."</tr>"
        


        ."<tr>"
        ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Fetch Database\" style=\"height:55px; width:285px\" onclick=\"location.href='fetch.php';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Home Page\" style=\"height:55px; width:285px\" onclick=\"location.href='../';\">"
          ."</td>"
        ."</tr>"


      ."</tbody>"
    ."</table>"
    ."</br>";

?>

</div>
</center>
</body>

<script>
function alert1() { alert("Disabled for security reasons. Open and edit manually `config.php` on your web server.") }
</script>
</html>