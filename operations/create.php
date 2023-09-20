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
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Tambah Stok Sepatu</h1>
        <form action="create.php" method="post">

        <label for="merk">Merk Sepatu:</label>
        <select name="merk" id="merk-dropdown" required>
            <option value="" disabled selected>Pilih Merk</option> <!-- Opsi default "Pilih Merk" -->
            <?php
            $stmt = $conn->query("SELECT id, nama_merk FROM merk");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nama_merk'] . "</option>";
            }
            ?>
        </select>

        <label for="tipe">Tipe Sepatu:</label>
        <select name="tipe" id="tipe-dropdown" disabled required> <!-- Dropdown "Tipe" awalnya dinonaktifkan -->
            <option value="" disabled selected>Pilih Tipe</option> <!-- Opsi default "Pilih Tipe" -->
            <!-- Daftar tipe akan diisi oleh kode JavaScript saat pengguna memilih merk -->
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
    <script>
        const merkDropdown = document.querySelector('#merk-dropdown');
        const tipeDropdown = document.querySelector('#tipe-dropdown');

        merkDropdown.addEventListener('change', function() {
            let merkId = this.value;

            if (merkId) {
                fetch(`get_tipe_by_merk.php?merk_id=${merkId}`)
                    .then(response => response.text())
                    .then(data => {
                        tipeDropdown.innerHTML = '<option value="" disabled selected>Pilih Tipe</option>' + data;
                        tipeDropdown.disabled = false; // Aktifkan dropdown "Tipe"
                    });
            } else {
                tipeDropdown.innerHTML = '<option value="" disabled selected>Pilih Tipe</option>';
                tipeDropdown.disabled = true; // Nonaktifkan dropdown "Tipe"
            }
        });
    </script>
</body>

</html>
