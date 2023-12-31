<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', '192.168.1.10');
define('DB_USERNAME', 'retail');
define('DB_PASSWORD', 'admin123');
define('DB_NAME', 'development');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$link) {
    // Koneksi ke database gagal, akhiri sesi
    session_start(); // Mulai sesi jika belum dimulai
    session_destroy(); // Hancurkan sesi
    header("Location: index.php"); // Arahkan ke halaman login atau halaman kesalahan
    exit;
}

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gmailid = ''; // YOUR gmail email
$gmailpassword = ''; // YOUR gmail App password
$gmailusername = ''; // YOUR gmail Username

?>