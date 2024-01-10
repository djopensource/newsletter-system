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
<div class="title">System Statistics</div>
<br>

<table width="550" cellspacing="2" cellpadding="8" border="0">
<tbody>
<tr>
<td valign="top\">
<div class="font1">Most countries in database.</div>

<?php
include ("../db.php");

function statistics() {
    global $db;
    echo "<br><font class=\"font1\">";
    $i = 1;
    $result = $db->sql_query("SELECT country, COUNT(*) x FROM users GROUP BY country HAVING x > 2 order by x desc");
    while ($row = $db->sql_fetchrow($result)) {
    $country = $row['country'];
    if ($country != "") {
      echo "<font class=\"font1\">";
      echo ("[$i] $country<br>");
      $i++;
      }
    }
}

statistics();

?>

</td>
<td valign="top">

<?php
include ("db.php");
function newsstats() {
    global $db;
    $trow = $db->sql_numrows($db->sql_query("select * from users where tester='1'"));
    $srow = $db->sql_numrows($db->sql_query("select * from users where subscribed='1'"));
    $unrow = $db->sql_numrows($db->sql_query("select * from users where subscribed='0'"));
    $urow = $db->sql_numrows($db->sql_query("select * from users"));
    echo "<br><font class=\"font1\">"
    ."<u>User Analytics</u><br></br>"
    ."Addresses receiving test email:<b> $trow </b></br>"
    ."Non-subscribed users in database:<b> $unrow </b></br>"
    ."Subscribed users in database:<b> $srow </b></br>"
    ."Total users in database:<b> $urow </b></br>"
    ."</font>";
}
newsstats();
?>

</td>
</tr>
<tr>
<td valign="top">
</td>
<td valign="top">
    
<?php
include ("db.php");
function deliveries() {
    global $db;
    $totaltestsent = $db->sql_fetchrow($db->sql_query("select totaltestsent,id from statistics where id='0'"));
    $totalsubsent = $db->sql_fetchrow($db->sql_query("select totalsubsent,id from statistics where id='0'"));
    $totalunsubsent = $db->sql_fetchrow($db->sql_query("select totalunsubsent,id from statistics where id='0'"));
    $totalsent = $db->sql_fetchrow($db->sql_query("select totalsent,id from statistics where id='0'"));
      
    $totaltestsent = $totaltestsent['totaltestsent'];
    $totalsubsent = $totalsubsent['totalsubsent'];
    $totalunsubsent = $totalunsubsent['totalunsubsent'];
    $totalsent = $totalsent['totalsent'];

    echo "<br><font class=\"font1\">"
    ."<u>E-mail Deliveries</u><br></br>"
    ."Test mails delivered:<b> $totaltestsent </b></br>"
    ."Deliveries to subscribers:<b> $totalsubsent </b></br>"
    ."Deliveries to non-subscribers:<b> $totalunsubsent </b></br>"
    ."Emails delivered in total:<b> $totalsent </b></br>"
    ."</font>";
}

deliveries();

?>

</td>
</tr>
<tr>
<td valign="top">
</td>
<td valign="top">
    
<?php
include ("db.php");
function statusstats() {
    global $db;
    $phpmyadmin = $db->sql_numrows($db->sql_query("select * from users where status='phpmyadmin'"));
    $addedmassively = $db->sql_numrows($db->sql_query("select * from users where status='uploaded'"));
    $addedbyadmin = $db->sql_numrows($db->sql_query("select * from users where status='added'"));
    $subscribed = $db->sql_numrows($db->sql_query("select * from users where status='subscribed'"));
    $bounced = $db->sql_numrows($db->sql_query("select * from users where status='bounced'"));
    $unsubscribed = $db->sql_numrows($db->sql_query("select * from users where status='unsubscribed'"));

    echo "<br><font class=\"font1\">"
    ."<u>Status Statistics</u><br></br>"
    ."Created in phpmyadmin:<b> $phpmyadmin </b></br>"
    ."Addresses added by text:<b> $addedmassively </b></br>"
    ."Addresses added by admin:<b> $addedbyadmin </b></br>"
    ."Users that subscribed manually:<b> $subscribed </b></br>"
    ."Bounced addresses:<b> $bounced </b></br>"
    ."Manually unsubscribed users:<b> $unsubscribed </b></br>"
    ."</font>";
}

statusstats();

?>

</td>
</tr>
<tr>
</tbody>
</table>
<br></br>
<input type="submit" class="button1" value="Back" style="height:45px; width:140px" onclick="location.href='index.php';">
</br>
</div>
</div>
</body>
</html>