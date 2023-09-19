<?php
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nama_merk = $_POST['nama_merk'];

        $stmt = $conn->prepare("INSERT INTO merk (nama_merk) VALUES (?)");
        $stmt->execute([$nama_merk]);

        header("Location: ../tampil.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Merk Sepatu</title>
    <link rel="stylesheet" href="../resource/main.css">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Tambah Merk Sepatu</h1>
        <form action="add_merk.php" method="post">
            <label for="nama_merk">Nama Merk:</label>
            <input type="text" name="nama_merk" required>
            <input type="submit" class="btn btn-primary" value="Tambah">
        </form>
    </div>
</body>

</html>
