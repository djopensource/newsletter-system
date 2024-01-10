
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
<form action="bounced.php" method="POST">
<br></br>
<center>
<div class="form1">
<div class="title">Imap Administration</div>
<br><div class="font1">Managing email account through imap.</div></br>

<?php

include ("../db.php");

$imap=imap_open($hostname,$username,$password) or die('Cannot connect: '.imap_last_error());
$counter = imap_num_msg($imap);
$count3r = imap_num_msg($imap);

#dont't delete - you see the folders in that way
#$mailboxes = imap_list($imap, $hostname, '*');
#$ah = var_dump($mailboxes);
#echo "<br>$ah</br>";

echo "<br>";

global $db;

for ($i = 1; $i <= $counter; ++$i){
  $header = imap_header($imap, $i);
  $body = imap_fetchbody($imap, $i, '2');
  $emaildate = date("jS F Y", $header->udate);
  $email1 = substr($body, 0, stripos($body, "Original-Recipient"));
  $email2 = end((explode('Final-Recipient: rfc822;', $email1, 2)));
  $email = trim($email2);

  $subject=$header->Subject;
  $to=$header->to[0]->host;
  $host=$header->From[0]->host;
  $status="bounced";
  echo "<font class=\"font1\">";
  echo "$email bounced and thus unsubscribed.</font></br>\n";
  #imap_mail_move($imap,'1:'.$counter,'INBOX.Trash');
  #which can also be a range.(ex: '1:15')
  #imap_close($imap,CL_EXPUNGE);
  $db->sql_query("UPDATE users SET subscribed=0 where email='$email'");
  $db->sql_query("UPDATE users SET status='$status' where email='$email'");
}

#$fp = fopen("log.htm", "a");
#fwrite($fp, "**** $count3r bounced emails were unsubscribed on " . date("Y.m.d h:i:sa") . "<br>");

echo "<font class=\"font1\">";
echo "</br><b>$counter</b> addresses were found in inbox and unsubscribed.</br>";
echo "</font>";
#echo "<br></br></br><input type=\"submit\" name=\"unsub\" class=\"button1\" value=\"Unsubscribe Bounced\" style=\"height:45px; width:245px\" ></br>";
echo "</br></br><input type=\"submit\" class=\"button1\" name=\"del\" value=\"Delete Inbox\" style=\"height:45px; width:170px\" >";
echo "&nbsp;&nbsp;<input type=\"submit\" class=\"button1\" name=\"trash\" value=\"Delete Trash\" style=\"height:45px; width:170px\" >";
echo "&nbsp;&nbsp;<input class=\"button1\" value=\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Back\" style=\"height:45px; width:140px\" onclick=\"location.href='javascript:history.go(-1)';\"></br>";

#unsub ();
#function unsub() {
#  if(isset($_POST['unsub'])) {
#    for ($i = 1; $i <= $counter; ++$i){
#      $header = imap_header($imap, $i);
#      $body = imap_fetchbody($imap, $i, '2');
#      $emaildate = date("jS F Y", $header->udate);
#      $email1 = substr($body, 0, stripos($body, "Original-Recipient"));
#      $email2 = end((explode('Final-Recipient: rfc822;', $email1, 2)));
#      $email = trim($email2);
#      $subject=$header->Subject;
#      $to=$header->to[0]->host;
#      $host=$header->From[0]->host;
#      $status="bounced";
#      echo "<font class=\"font2\">";
#      echo "$email unsubscribed.";
#      echo "<br><br></font>";
#      global $db;
#      $db->sql_query("UPDATE users SET subscribed=0 where email='$email'");
#      $db->sql_query("UPDATE users SET status='$status' where email='$email'");
#    }
#  }
#}

del ();
function del() {
  if(isset($_POST['del'])) {
	include ("../db.php");
	imap_close($imap);
	$imap=imap_open($hostname,$username,$password) or die('Cannot connect: '.imap_last_error());
    $c0unt3r = imap_num_msg($imap);
#    imap_mail_move($imap,'1:2','INBOX.Trash');
	imap_mail_move($imap,'1:'.$c0unt3r,'INBOX.Trash');
    echo "<font class=\"font2\"><br></br>All messages were moved to trash bin.</font>";
	$fp = fopen("log.htm", "a");
    fwrite($fp, "**** $c0unt3r bounced emails were moved to trash on " . date("Y.m.d h:i:sa") . "<br>");
	imap_close($imap,CL_EXPUNGE);
  }
}

trash();
function trash() {
  if(isset($_POST['trash'])) {
	include ("../db.php");
	imap_close($imap);
	$imap=imap_open($hostname,$username,$password) or die('Cannot connect: '.imap_last_error());
#    $counter = imap_num_msg($imap);
    imap_delete($imap, '1:*', 'INBOX.Trash');
#    imap_close($imap,CL_EXPUNGE);
	imap_expunge($imap);
    echo "<font class=\"font2\"><br></br>Trash bin is now empty.</font>";
	$fp = fopen("log.htm", "a");
    fwrite($fp, "**** Trash bin was purged on " . date("Y.m.d h:i:sa") . "<br>");
  }
}

print_r(imap_errors());
imap_close($imap);

?>

</div>
</form>
</body>
</html>