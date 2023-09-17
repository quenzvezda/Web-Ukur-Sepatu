<?php
include '../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $tipe = $_POST['tipe'];
        $merk = $_POST['merk'];
        $harga = $_POST['harga'];
        $ukuran = $_POST['ukuran'];
        $jumlah_stok = $_POST['jumlah_stok'];

        $stmt = $conn->prepare("INSERT INTO stok (tipe, merk, harga, ukuran, jumlah_stok) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$tipe, $merk, $harga, $ukuran, $jumlah_stok]);

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
    <title>Tambah Stok Sepatu</title>
    <link rel="stylesheet" href="../resource/main.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="../tampil.php">Beranda</a></li>
            <li><a href="../operations/create.php">Tambah Stok</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Tambah Stok Sepatu</h1>
        <form action="create.php" method="post">
            <label for="tipe">Tipe Sepatu:</label>
            <select name="tipe" required>
                <?php
                $stmt = $conn->query("SELECT id, nama_tipe FROM tipe");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nama_tipe'] . "</option>";
                }
                ?>
            </select>

            <label for="merk">Merk Sepatu:</label>
            <select name="merk" required>
                <?php
                $stmt = $conn->query("SELECT id, nama_merk FROM merk");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nama_merk'] . "</option>";
                }
                ?>
            </select>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" required>

            <label for="ukuran">Ukuran:</label>
            <input type="number" step="0.1" name="ukuran" required>

            <label for="jumlah_stok">Jumlah Stok:</label>
            <input type="number" name="jumlah_stok" required>

            <input type="submit" class="btn btn-primary" value="Tambah">
        </form>
    </div>
</body>

</html>
