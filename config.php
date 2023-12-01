<?php
define('DB_SERVER', 'localhost'); //localhost:3036
define('DB_USERNAME', 'haddad');
define('DB_PASSWORD', 'passcode');
define('DB_DATABASE', 'amar');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET 'uft8'");
mysqli_query($db, "SET character_set_connection 'utf8'");

$hadis = mysqli_connect('localhost', 'haddad', 'passcode', 'hadis');
?>
