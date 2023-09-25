<?php
include '../includes/config.php';

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM stok WHERE id=?");
    $stmt->execute([$id]);

    header("Location: ../tampil.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
