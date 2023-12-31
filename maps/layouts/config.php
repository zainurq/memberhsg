<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'hsgcoid');
define('DB_PASSWORD', '8lQ22B-3Y*Gpux');
define('DB_NAME', 'hsgcoid_maps');

/* Attempt to connect to MySQL database */
$linked = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($linked === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gmailid = ''; // YOUR gmail email
$gmailpassword = ''; // YOUR gmail App password
$gmailusername = ''; // YOUR gmail Username

?>