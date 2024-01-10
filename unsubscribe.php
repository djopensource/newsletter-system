<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Newsletter platform by Angelos Mavros</title>
<meta name="robots" content="noydir">
<meta name="robots" content="noodp">
<LINK REL="SHORTCUT ICON" HREF="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<form action="unsubscribe.php" method="POST">
<br></br>
<center>
<div class="form1">
<div class="title">Unsubscribe</div>
<br>
<div class="font1">To unsubscribe from our mailing list, please enter your e-mail address in the input box below.</div>
</br>
<label><span class="title2">Your e-mail address <b>*</b></span></label>
</br>
<input name="mail" class="input_box2" style="height:35px; width:240px" type="text" placeholder=" type here" required></br>
</br>

<div class="font2">Antispam: <i>3 + 2 = </i><input type="text" style="height:20px; width:20px" name="antispam" VALUE="" size=2 maxlength=1 required></div></br>

<input class="button1" value="Remove" style="height:50px; width:190px" name="modify_entry" type="submit">

<?php
include ("db.php");

if(isset($_POST['modify_entry'])) {
  $antispam = $_POST['antispam'];
  if ($antispam != 5) {
  echo "<br></br><font class=\"font3\"><i>Wrong security answer.</i></br></font>";
  }else{
  unsubscribe();
  }
}

function unsubscribe() {
    global $db;
    $value = $_POST['mail'];
    $tester = "0";
    $subscribed = "0";
    $status = "unsubscribed";
    $grammes = $db->sql_numrows($db->sql_query("select * from users where email='$value'"));
    if ($grammes < 1) {
      echo "<br></br><font class=\"font3\"><i>E-mail address NOT in database.</i></font>";
    }else{
      $row = $db->sql_fetchrow($db->sql_query("SELECT subscribed from users where email='$value'"));
      $subscribed = $row['subscribed'];
      echo "<br></br><font class=\"font3\"><i>Successfully unsubscribed.</i></font>";
      $db->sql_query("UPDATE users SET subscribed=0 where email='$value'");
      $db->sql_query("UPDATE users SET status='$status' where email='$value'");
	  $fp = fopen("admin/log.htm", "a");
      fwrite($fp, "address $value unsubscribed from database on " . date("Y.m.d h:i:sa") . "<br>");
    }
}
?>

</div>
</form>
</body>
</html>