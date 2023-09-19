<?php
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nama_tipe = $_POST['nama_tipe'];
        $id_merk = $_POST['id_merk'];

        $stmt = $conn->prepare("INSERT INTO tipe (nama_tipe, id_merk) VALUES (?, ?)");
        $stmt->execute([$nama_tipe, $id_merk]);

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
    <title>Tambah Tipe Sepatu</title>
    <link rel="stylesheet" href="../resource/main.css">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Tambah Tipe Sepatu</h1>
        <form action="add_type.php" method="post">
            <label for="nama_tipe">Nama Tipe:</label>
            <input type="text" name="nama_tipe" required>

            <label for="id_merk">Merk Sepatu:</label>
            <select name="id_merk" required>
                <?php
                $stmt = $conn->query("SELECT id, nama_merk FROM merk");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nama_merk'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" class="btn btn-primary" value="Tambah">
        </form>
    </div>
</body>

</html>
