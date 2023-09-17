<?php
$host = "localhost";
$db   = "sepatu";
$user = "root";
$pass = "";
$koneksi = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
