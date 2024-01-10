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
<div class="title">Main Menu</div>
<br><div class="font1">Newsletter system version 1.0 by Angelos Mavros based on php / mysql.</div></br>

<?php
echo ""
    ."<table width=\"550\" cellspacing=\"2\" cellpadding=\"8\" border=\"0\">"
      ."<tbody>"
        ."<tr>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" value=\"Subscribe User\" style=\"height:55px; width:285px\" onclick=\"location.href='subscribe.php';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Unsubscribe User\" style=\"height:55px; width:285px\" onclick=\"location.href='unsubscribe.php';\">"
          ."</td>"
        ."</tr>"

        ."<tr>"
        ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Search Database\" style=\"height:55px; width:285px\" onclick=\"location.href='/search.php';\">"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Updates on Github\" style=\"height:55px; width:285px\" onclick=\"location.href='https://www.github.com/djopensource';\">"
          ."</td>"
        ."</tr>"
        
        ."<tr>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"About\" style=\"height:55px; width:285px\" onclick=\"location.href='readme.txt';\" >"
          ."</td>"
          ."<td valign=\"top\"><br>"
          ."<input type=\"submit\" class=\"button1\" name=\"op\" value=\"Administration\" style=\"height:55px; width:285px\" onclick=\"location.href='/admin/';\">"
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