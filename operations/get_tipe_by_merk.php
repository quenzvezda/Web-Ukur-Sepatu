<?php
include '../includes/config.php';

if(isset($_GET['merk_id'])) {
    $merk_id = $_GET['merk_id'];
    $stmt = $conn->prepare("SELECT id, nama_tipe FROM tipe WHERE id_merk = ?");
    $stmt->execute([$merk_id]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['id'] . "'>" . $row['nama_tipe'] . "</option>";
    }
}
?>