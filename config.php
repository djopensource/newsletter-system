<?php

#general configuration

$dbhost = "db43.grserver.gr:3306";
$dbuname = "newslett3r";
$dbpass = "12345";
$dbname = "newsletter";
$display_errors = true;
$dbtype = "MySQL";
$sitename = "Newsletter System";
$adminmail = "noreply@yourdomain.com";

#bounce_administration_configuration

$username = "noreply@yourdomain.com";
$password = "12345";
$hostname = "{rlinux26.grserver.gr:993/imap/ssl}INBOX";

######################################################
#the user/pass to login to the admin panel is stored in .htpasswd file
#to create a new encrypted password use the file "hash.php"
# default user/pass: cheese burger
######################################################

#########################################################################
#edit "yourdomain" in the .htaccess & .htpasswd files in the admin folder
#########################################################################

?>