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
<form action="search.php" method="POST">
<br></br>
<center>
<div class="form1">
<div class="title">Search Database</div>
<br>
<div class="font1">Look for a specific string in the database.</div>
<br>
<label><span class="title2">Enter term <b>*</b></span></label>
<br>
<input class="input_box2" style="height:35px; width:290px" minlength="3" name="string" type="text" onKeyDown="myFunction(event)" placeholder="3 characters minimum" required> </br>
<br>
<input class="button1" style="height:45px; width:140px" value="Search" name="search_db" type="submit">
&nbsp;
<input type="submit" class="button1" value="Back" style="height:45px; width:140px" onclick="location.href='index.php';" >
<br><br>

<?php
include ("db.php");
search ();
function search() {
    global $sitename, $db;
    if(isset($_POST['search_db'])) {
      $string = $_POST['string'];
      $grammes = $db->sql_numrows($db->sql_query("select * from users where INSTR(email, '{$string}') > 0"));
      $result = $db->sql_query("select email,subscribed from users where INSTR(email, '{$string}') > 0");
      while ($row = $db->sql_fetchrow($result)) { 
      $email = $row['email'];
      $subscribed = $row['subscribed'];
      }
      if ($subscribed == "1") {
          $status = "subscribed.";
      }else{
          $status = "unsubscribed.";
      }
      if ($grammes > 0) {
        $go = $db->sql_query("select email from users where INSTR(email, '{$string}') > 0");
        while ($row = $db->sql_fetchrow($go)) {
        $email = $row['email'];
        echo "<font class=\"font1\">Term<b> $string </b>found in database as<b> $email </b>with status <b> $status </b></br></font>";
        }
      } else {
        echo "<font class=\"font1\"><i>No results.</i></font></br>";
      }
  }
}

?>

</div>
</form>
</body>
</html>