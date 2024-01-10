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
<div class="title">Newsletter</div>
	<br><div class="font1"><i>Composing a new bulk e-mail..</i></div></br>

<?php

include ("../db.php");

function compose() {
    global $db, $sitename, $adminmail ;
    $trow = $db->sql_numrows($db->sql_query("select * from users where tester='1'"));
    $srow = $db->sql_numrows($db->sql_query("select * from users where subscribed='1'"));
    $unrow = $db->sql_numrows($db->sql_query("select * from users where subscribed='0'"));
    $urow = $db->sql_numrows($db->sql_query("select * from users"));

    echo "<font class=\"font1\">";
    echo "<form method=\"post\" >";
    echo "<br>Import previous mail: <select name=\"forms\" onchange=\"this.form.submit()\">";
    $path1 = explode ("/", "forms/");
    $path = "$path1[0]/$path1[1]";
    $handle = opendir($path);
    while ($file = readdir($handle)) {
        if ($file != "AllTopics.gif") {
            $filelist .= "$file ";
        }
    }
    closedir($handle);
    $filelist = explode(" ", $filelist);
    sort($filelist);
    for ($i=0; $i < sizeof($filelist); $i++) {
		if($filelist[$i]==".") {
            echo "<option name=\"forms\" value=\"$filelist[$i]\">create_new\n";
        }
		elseif($filelist[$i]=="..") {
        }
		elseif($filelist[$i]!="") {
            echo "<option name=\"forms\" value=\"$filelist[$i]\">$filelist[$i]\n";
        }
    }
    echo "</select></form>";
    
    if(isset($_POST["forms"])) {
      $form=$_POST["forms"];
      $content = file_get_contents("./forms/$form");
    }

    echo ""
    ."<font class=\"font1\">"
    ."<br><form method=\"post\" action=\"newsletter.php\">"
    ."<b>From:</b> " . $sitename . ""
    ."<br></br>"
    ."<b>From address:</b> " . $adminmail . ""
    ."<br><br>"
    ."<b>Subject: </b><input class=\"input_box\" type=\"text\" name=\"subject\" minlength=\"5\" maxlength=\"100\" size=\"70\"placeholder=\"minimum 5 characters\" required>"
    ."<br></br>"
    ."<b>Content:</b><br><textarea style=\"resize: none\" class=\"input_box\" name=\"content\" minlength=\"30\" maxlength=\"3000\" cols=\"74\" rows=\"17\" placeholder=\"minimum 30 characters\" required> $content </textarea>"
    ."<br><br>"
    ."<b>Do what?</b><br>"
    ."&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=\"radio\" name=\"type\" value=\"tester\" checked> Send a test mail ($trow addresses)</br>"
    ."&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=\"radio\" name=\"type\" value=\"unsub\"> Send to non-subscribers ($unrow unsubscribed)</br>"
    ."&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=\"radio\" name=\"type\" value=\"sub\"> Send to subscribers ($srow subscribers)</br>"
    ."&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=\"radio\" name=\"type\" value=\"massmail\"> Send to everyone ($urow total users)</br>"
    ."<br>"
    ."<b>Choose interval according to server`s policy.</b><br>"
    ."Seconds between e-mails: <input class=\"input_box\" type=\"number\" name=\"seconds\" style=\"height:2em; width:3em\" value=\"14\" min=\"0\" max=\"30\" >"
    ."<br><br></br>"
    ."<input type=\"hidden\" name=\"op\" value=\"check_type\">"
    ."<input class=\"button1\" type=\"submit\" style=\"height:45px; width:190px\" value=\"Preview\">"
    ."&nbsp; &nbsp; <input class=\"button1\" style=\"height:45px; width:190px\" value=\"&nbsp; &nbsp; &nbsp; &nbsp;  Go Back\" onclick=\"location.href='javascript:history.go(-1)';\" >"
    ."</form>";
}

function check_type($subject, $content, $type, $seconds) {
    global $db, $sitename, $adminmail;
    $trow = $db->sql_numrows($db->sql_query("select * from users where tester='1'"));
    $srow = $db->sql_numrows($db->sql_query("select * from users where subscribed='1'"));
    $unrow = $db->sql_numrows($db->sql_query("select * from users where subscribed='0'"));
    $urow = $db->sql_numrows($db->sql_query("select * from users"));
    echo "<font class=\"font1\">";
    echo "<i>Previewing the e-mail before it goes away..</i>";
    echo "<br></br>";
    $content = stripslashes($content);
    $subject = stripslashes($subject);
    $seconds = intval($seconds);
    echo ""
    ."<br><form action\"newsletter.php\" method=\"post\">"
    ."<b>From:</b> " . $sitename . "<br><br>"
    ."<b>From address:</b> " . $adminmail . "<br><br>"
    ."<b>Subject: </b>   <input type=\"text\" class=\"input_box\" name=\"subject\" minlength=\"5\" maxlength=\"100\" value=\"$subject\" size=\"70\" placeholder=\"at least 5 characters\" required>"
    ."<br><br><b>Content:</b><br><textarea style=\"resize: none\" name=\"content\" class=\"input_box\" minlength=\"30\" maxlength=\"3000\" cols=\"74\" rows=\"7\" placeholder=\"minimum 30 characters\" required>$content</textarea></br>";
    
    #."<br><b>$content</b></br>";
    #printf("<p>%s</p>", $content);

    echo ""
    ."Intervals between emails: <input type=\"number\" class=\"input_box\" name=\"seconds\" value=\"$seconds\" style=\"height:2em; width:3em\" value=\"$seconds\" min=\"0\" max=\"30\" ></br></br>";
    if ($type == "tester") {
        echo ""
        ."You are about to send a <b>test mail</b> to<b> $trow </b>addresses.<br><br></br>"
        ."<input type=\"hidden\" name=\"op\" value=\"tester_send\">";
    } elseif ($type == "unsub") {
        echo ""
        ."You are about to send a mail to $unrow unsubscribed addresses.<br><br></br>"
        ."<input type=\"hidden\" name=\"op\" value=\"unsub_send\">";
    } elseif ($type == "sub") {
        echo ""
        ."You are about to send a mass mail to $srow subscribers.<br><br>"
        ."<input type=\"hidden\" name=\"op\" value=\"sub_send\">";
    } elseif ($type == "massmail") {
        echo ""
        ."You are about to send a mass mail to everyone. There are $urow addresses in total on the database.<br><br>"
        ."<input type=\"hidden\" name=\"op\" value=\"massmail_send\">";
    }
    echo "<input type=\"submit\" class=\"button1\" style=\"height:45px; width:190px\" value=\"Send it\">";
    echo "&nbsp; &nbsp; <input class=\"button1\" style=\"height:45px; width:190px\" value=\"&nbsp; &nbsp; &nbsp; &nbsp;  Go Back\" onclick=\"location.href='javascript:history.go(-1)';\" >";
	echo "</form>";
}

function tester_send($subject, $content, $seconds) {
    global $sitename, $db, $adminmail;
    $from = $adminmail;
    $subject = stripslashes($subject);
    $content = stripslashes($content);
    $seconds = intval($seconds);
    $loops = 0 ;
    $result = $db->sql_query("SELECT email from users where tester='1'");
    $fp = fopen("log.htm", "a");
    fwrite($fp, "*** Test mail initiated on " . date("Y.m.d h:i:sa") . "<br>");
    while ($row = $db->sql_fetchrow($result)) {
        $email = $row['email'];
        $headers = "From: " . $sitename . " <" . $adminmail . ">\n";
        $headers .= "X-Sender: <" . $adminmail . ">\n";
        $headers .= "X-Mailer: PHP\n";
        $headers .= "X-Priority: 6\n"; // Urgent message!
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        mail("$email","$subject","$content",$headers);
        fwrite($fp, "mail with subject $subject was sent to $email on " . date("Y.m.d h:i:sa") . "<br>");
        sleep($seconds);
        $loops = intval($loops) + 1;
    }
    echo "<font class=\"font1\">";
    echo "<b>Success.</b><br>";
    echo "</br>$loops test mails </b> were sent with a delay of <b>$seconds seconds</b> in between.</b>";
    $row = $db->sql_fetchrow($db->sql_query("SELECT totaltestsent,id from statistics where id='0'"));
    $totaltestsent = $row['totaltestsent'];
    $adding = intval($totaltestsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totaltestsent='$adding' where id='0'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalsent,id from statistics where id='0'"));
    $totalsent = $row['totalsent'];
    $adding2 = intval($totalsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalsent='$adding2' where id='0'");
    echo "<br></br></br><input type=\"submit\" class=\"button1\" value=\"Main Menu\" style=\"height:45px; width:140px\" onclick=\"location.href='index.php';\"></br>";
	$formname = date("Y-m-d");
    $fp = fopen("forms/$formname", "a");
    fwrite($fp, $content);
}

function sub_send($subject, $content, $seconds) {
    global $sitename, $db, $adminmail;
    $from = $adminmail;
    $subject = stripslashes($subject);
    $content = stripslashes($content);
    $seconds = intval($seconds);
    $loops = 0 ;
    $result = $db->sql_query("SELECT email from users where subscribed='1'");
    $fp = fopen("log.htm", "a");
    fwrite($fp, "*** Mass mail to subscribers initiated on " . date("Y.m.d h:i:sa") . "<br>");
    while ($row = $db->sql_fetchrow($result)) {
        $email = $row['email'];
        $headers = "From: " . $sitename . " <" . $adminmail . ">\n";
        $headers .= "X-Sender: <" . $adminmail . ">\n";
        $headers .= "X-Mailer: PHP\n";
        $headers .= "X-Priority: 6\n"; // Urgent message!
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        mail("$email","$subject","$content",$headers);
        fwrite($fp, "mail with subject $subject was sent to $email on " . date("Y.m.d h:i:sa") . "<br>");
        sleep($seconds);
        $loops = intval($loops) + 1;
    }
    echo "<font class=\"font1\">";
    echo "<b>Success.</b><br>";
	echo "</br><b>$loops mails</b> were sent to <b>subscribers</b> with a delay of <b>" . $seconds . " seconds </b> in between.";
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalsubsent,id from statistics where id='0'"));
    $totalsubsent = $row['totalsubsent'];
    $adding = intval($totalsubsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalsubsent='$adding' where id='0'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalsent,id from statistics where id='0'"));
    $totalsent = $row['totalsent'];
    $adding2 = intval($totalsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalsent='$adding2' where id='0'");
    echo "<br></br></br><input type=\"submit\" class=\"button1\" value=\"Main Menu\" style=\"height:45px; width:140px\" onclick=\"location.href='index.php';\"></br>";
    $formname = date("Y-m-d");
    $fp = fopen("forms/$formname", "a");
    fwrite($fp, $content);
}

function unsub_send($subject, $content, $seconds) {
    global $sitename, $db, $adminmail;
    $from = $adminmail;
    $subject = stripslashes($subject);
    $content = stripslashes($content);
    $seconds = intval($seconds);
    $loops = 0 ;
    $result = $db->sql_query("SELECT email from users where subscribed='0'");
    $fp = fopen("log.htm", "a");
    fwrite($fp, "*** Mass mail to unsubscribed users initiated on " . date("Y.m.d h:i:sa") . "<br>");
    while ($row = $db->sql_fetchrow($result)) {
        $email = $row['email'];
        $headers = "From: " . $sitename . " <" . $adminmail . ">\n";
        $headers .= "X-Sender: <" . $adminmail . ">\n";
        $headers .= "X-Mailer: PHP\n";
        $headers .= "X-Priority: 6\n"; // Urgent message!
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        mail("$email","$subject","$content",$headers);
        fwrite($fp, "mail with subject $subject was sent to $email on " . date("Y.m.d h:i:sa") . "<br>");
        sleep($seconds);
        $loops = intval($loops) + 1;
    }
    echo "<font class=\"font1\">";
    echo "<b>Success.</b><br>";
	echo "</br><b>$loops mails</b> were sent to <b>unsubscribed addresses</b> with a delay of <b>" . $seconds . " seconds</b> in between.";
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalunsubsent,id from statistics where id='0'"));
    $totalunsubsent = $row['totalunsubsent'];
    $adding = intval($totalunsubsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalunsubsent='$adding' where id='0'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalsent,id from statistics where id='0'"));
    $totalsent = $row['totalsent'];
    $adding2 = intval($totalsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalsent='$adding2' where id='0'");
    echo "<br></br></br><input type=\"submit\" class=\"button1\" value=\"Main Menu\" style=\"height:45px; width:140px\" onclick=\"location.href='index.php';\"></br>";
}

function massmail_send($subject, $content, $seconds) {
    global $sitename, $db, $adminmail;
    $from = $adminmail;
    $subject = stripslashes($subject);
    $content = stripslashes($content);
    $seconds = intval($seconds);
    $loops = 0 ;
    $result = $db->sql_query("SELECT email from users where user_id != '0'");
    $fp = fopen("log.htm", "a");
    fwrite($fp, "*** Mass mail to all users initiated on " . date("Y.m.d h:i:sa") . "<br>");
    while ($row = $db->sql_fetchrow($result)) {
        $email = $row['email'];
        $headers = "From: " . $sitename . " <" . $adminmail . ">\n";
        $headers .= "X-Sender: <" . $adminmail . ">\n";
        $headers .= "X-Mailer: PHP\n";
        $headers .= "X-Priority: 6\n"; // Urgent message!
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        mail("$email","$subject","$content",$headers);
        fwrite($fp, "mail with subject $subject was sent to $email on " . date("Y.m.d h:i:sa") . "<br>");
        sleep($seconds);
        $loops = intval($loops) + 1;
    }
    echo "<font class=\"font1\">";
    echo "<b>Success.</b><br>";
    echo "</br><b>$loops total e-mails</b> were sent to everyone in the database with a delay of <b>" . $seconds . " seconds.</b>";
    $row = $db->sql_fetchrow($db->sql_query("SELECT totalsent,id from statistics where id='0'"));
    $totalsent = $row['totalsent'];
    $adding2 = intval($totalsent) + $loops ;
    $db->sql_query("UPDATE statistics SET totalsent='$adding2' where id='0'");
    echo "<br></br></br><input type=\"submit\" class=\"button1\" value=\"Main Menu\" style=\"height:45px; width:140px\" onclick=\"location.href='index.php';\"></br>";
//bullshit system to double up the unsubscribed in the statistics
    $result3 = $db->sql_query("SELECT email from users where subscribed='0'");
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT totalunsubsent,id from statistics where id='0'"));
    $totalunsubsent = $row3['totalunsubsent'];
    $adding3 = intval($totalunsubsent) + intval($totalunsubsent) ;
    $db->sql_query("UPDATE statistics SET totalunsubsent='$adding3' where id='0'");
//bullshit system to double up the subscribed in the statistics
    $result4 = $db->sql_query("SELECT email from users where subscribed='1'");
    $row4 = $db->sql_fetchrow($db->sql_query("SELECT totalsubsent,id from statistics where id='0'"));
    $totalsubsent = $row4['totalsubsent'];
    $adding4 = intval($totalsubsent) + intval($totalsubsent) ;
    $db->sql_query("UPDATE statistics SET totalsubsent='$adding4' where id='0'");
}

switch ($op) {
    case "compose":
    compose();
    break;
    case "check_type":
    check_type($subject, $content, $type, $seconds);
    break;
    case "tester_send":
    tester_send($subject, $content, $seconds);
    break;
    case "unsub_send":
    unsub_send($subject, $content, $seconds);
    break;
    case "sub_send":
    sub_send($subject, $content, $seconds);
    break;
    case "massmail_send":
    massmail_send($subject, $content, $seconds);
    break;
}

?>

</div>
</body>
</html>