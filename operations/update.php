<?php
include '../includes/config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $tipe = $_POST['tipe'];
        $merk = $_POST['merk'];
        $harga = $_POST['harga'];
        $ukuran = $_POST['ukuran'];
        $jumlah_stok = $_POST['jumlah_stok'];

        $stmt = $conn->prepare("UPDATE stok SET tipe=?, merk=?, harga=?, ukuran=?, jumlah_stok=? WHERE id=?");
        $stmt->execute([$tipe, $merk, $harga, $ukuran, $jumlah_stok, $id]);

        header("Location: ../tampil.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM stok WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stok Sepatu</title>
    <link rel="stylesheet" href="../resource/main.css">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Update Stok Sepatu</h1>
        <form action="update.php?id=<?php echo $id; ?>" method="post">
            <label for="tipe">Tipe Sepatu:</label>
            <select name="tipe" required>
                <?php
                $stmt = $conn->query("SELECT id, nama_tipe FROM tipe");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'" . ($data['tipe'] == $row['id'] ? 'selected' : '') . ">" . $row['nama_tipe'] . "</option>";
                }
                ?>
            </select>

            <label for="merk">Merk Sepatu:</label>
            <select name="merk" required>
                <?php
                $stmt = $conn->query("SELECT id, nama_merk FROM merk");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'" . ($data['merk'] == $row['id'] ? 'selected' : '') . ">" . $row['nama_merk'] . "</option>";
                }
                ?>
            </select>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required>

            <label for="ukuran">Ukuran:</label>
            <input type="number" step="0.1" name="ukuran" value="<?php echo $data['ukuran']; ?>" required>

            <label for="jumlah_stok">Jumlah Stok:</label>
            <input type="number" name="jumlah_stok" value="<?php echo $data['jumlah_stok']; ?>" required>

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>
</body>

</html>
