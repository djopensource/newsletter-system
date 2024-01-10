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
<form action="subscribe.php" method="POST">
<br></br>
<center>
<div class="form1">
<div class="title">Subscribe</div>
<br>
<div class="font1">To subscribe to our mailing list, enter your e-mail address in the input box below.</div>
</br>
<label><span class="title2">Your e-mail address <b>*</b></span></label>
</br>
<input name="mail" class="input_box2" style="height:35px; width:240px" type="text" placeholder=" type here" required></br>
</br>

<div class="font2">Antispam: <i>1 + 2 = </i><input type="text" style="height:20px; width:20px" name="antispam" VALUE="" size=2 maxlength=1 required></div></br>

<input class="button1" value="Subscribe" style="height:50px; width:190px" name="new_entry" type="submit">

<?php

include ("db.php");

if(isset($_POST['new_entry'])) {
  $antispam = $_POST['antispam'];
  if ($antispam != 3) {
  echo "<br></br><font class=\"font3\"><i>Wrong security answer.</i></br></font>";
  }else{
  subscribe();
  }
}

function subscribe() {
    global $db;
    $value = $_POST['mail'];
    $tester = "0";
    $subscribed = "1";
    $status = "subscribed";
    $grammes = $db->sql_numrows($db->sql_query("select * from users where email='$value'"));
    if ($grammes > 0) {
      echo "<br></br><font class=\"font3\"><i>Resubscribed.</i></font></br>";
	  $fp = fopen("admin/log.htm", "a");
      fwrite($fp, "address $value re-subscribed to database on " . date("Y.m.d h:i:sa") . "<br>");
      $db->sql_query("UPDATE users SET subscribed=1 where email='$value'");
      $db->sql_query("UPDATE users SET status='$status' where email='$value'");
    }else{
      $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 
      if (eregi($pattern, $value)){ 
      echo "<br></br><font class=\"font3\"><i>Added in database.</i></font></br>";
	  include ("country.php");
      $db->sql_query("INSERT INTO users (user_id, email, tester, subscribed, status, country) VALUES (NULL, '$value', '$tester', '$subscribed', '$status', '$country')");
	  $fp = fopen("admin/log.htm", "a");
      fwrite($fp, "address $value subscribed to database on " . date("Y.m.d h:i:sa") . "<br>");
      }
      else {
          echo "<br></br><font class=\"font3\"><i>Invalid e-mail format.</i></font></br>";
      }
    
  }
}

?>

</div>
</form>
</body>
</html>