<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "root";
$database = "sepatu";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}

// Ambil data dari request POST
$panjang = $_POST['panjang'];
$lebar = $_POST['lebar'];

// Masukkan data ke tabel buffer
$query = "INSERT INTO buffer (panjang, lebar) VALUES (?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("dd", $panjang, $lebar);
$stmt->execute();

// Tutup koneksi
$stmt->close();
$connection->close();
?>
