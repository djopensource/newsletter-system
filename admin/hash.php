<?php
$username = 'cheese';
$password = 'burger';
$encrypted_password = crypt($password, base64_encode($password));
echo "open the file with an editor to create a new hash<br>";
echo "use the encrypted hash in the htpasswd file<br></br>";
echo "encoded username/password<br>";
echo $username . ':' . $encrypted_password;
echo "<br></br>";
echo "original username/password<br>";
echo $username  . ':' . $password;
?>
