
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
<div class="title">Add New Entries</div>
<br><div class="font1">Add new mail addresses into the database.</div></br>
<form method=post action="upload.php" enctype="multipart/form-data">
<font class="font1">
<br>Paste below<br><textarea style="resize: none" class="input_box" minlength="6" placeholder="1 e-mail address per line" name="data" cols=55 rows=19></textarea></br>
<br><i>or</i></br>
<br><input type="file" class="button2" style="height:23px; width:96px" id="file" name="file">
</br></br></br>
<input type="submit" class="button1" style="height:45px; width:190px" name="add_entries" value="Add Entries">
&nbsp;&nbsp;<input class="button1" style="height:45px; width:100px" value="&nbsp;&nbsp;&nbsp;&nbsp;Back" onclick="location.href='index.php';">

</form>

<?php

include ("../db.php");

function add_from_textarea() {
    global $sitename, $db;
      if(isset($_POST['add_entries'])) {
        $text = trim($_POST['data']);
        $array = explode("\n", $text);
        #echo var_dump($array) ;
        $value = trim($array);
        $reason = "added";
        $i = 0;
        $y = 0;
        foreach ($array as $value) {
          if(empty($value)) { continue; }
			
          $rowz = $db->sql_numrows($db->sql_query("SELECT email FROM users WHERE email = '$value'"));
          if($rowz == 0 && $value !="") { 
                include ("../country.php");
                $db->sql_query("INSERT INTO users (email,status,country) VALUES ('$value','$reason','$country')"); 
                $i++;
		  } else {
              echo "<br></br><font class=\"font2\"><i>Address $value already exists in database.</i></font>";
              $y++;
          }
        }
        if(!empty($text)) {
        echo "<br></br><font class=\"font2\">Import completed. $i addresses imported. $y were already in database.</font>";
        $fp = fopen("log.htm", "a");
        fwrite($fp, "** Import completed on " . date("Y.m.d h:i:sa") . ". $i new valid addresses were imported and $y were already in the database.<br>");
        }
      }
}

function add_from_file() {
    global $sitename, $db;
    if(isset($_POST['add_entries'])) {
    $thefile = $_FILES['file']['tmp_name'];
    $open = fopen($thefile, 'r') or exit() ;
    $reason = "uploaded";
    $i = 0;
    $y = 0;
    echo "<br>";
    while (!feof($open)) {
      $getTextLine = fgets($open);
      $explodeLine = explode(",",$getTextLine);
      list($value) = $explodeLine;
	  if(empty($value)) { continue; }
		
      $rowz = $db->sql_numrows($db->sql_query("SELECT email FROM users WHERE email = '$value'"));
          if($rowz == 0) {
              include ("../country.php");
              $db->sql_query("INSERT INTO users (email,status,country) VALUES ('$value','$reason','$country')");
              $i++;
          } else {
              echo "<br><font class=\"font2\"><i>Address $value already exists in database.</i></font>";
              $y++;
          }
    }
    echo "<br></br><font class=\"font1\">Import completed. $i addresses imported. $y were already in database.</font>";
    fclose($open);
    $fp = fopen("log.htm", "a");
    fwrite($fp, "** Import completed on " . date("Y.m.d h:i:sa") . ". $i new valid addresses were imported and $y were already in the database.<br>");
  }
}

add_from_textarea();
add_from_file();

?>

</div>
</body>
</html>