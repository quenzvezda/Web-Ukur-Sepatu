<?php
include 'koneksi.php';  // Mengimpor koneksi database

// Mengambil semua merk dari tabel merk
$stmtMerk = $koneksi->prepare("SELECT id, nama_merk FROM merk");
$stmtMerk->execute();
$all_merks = $stmtMerk->get_result()->fetch_all(MYSQLI_ASSOC);

$defaultMerkId = $all_merks[0]['id'];
$stmtDefaultTipe = $koneksi->prepare("SELECT id, nama_tipe FROM tipe WHERE id_merk = ?");
$stmtDefaultTipe->bind_param("i", $defaultMerkId);
$stmtDefaultTipe->execute();
$default_tipes = $stmtDefaultTipe->get_result()->fetch_all(MYSQLI_ASSOC);

// Jika tombol 'add_stok' ditekan
if (isset($_POST['add_stok'])) {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $jumlah_stok = $_POST['jumlah_stok'];

    // Memasukkan data ke database
    $stmt = $koneksi->prepare("INSERT INTO stok (tipe, merk, harga, ukuran, jumlah_stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiidi", $tipe, $merk, $harga, $ukuran, $jumlah_stok);
    $stmt->execute();

    // Mengatur pesan sukses
    $message = "Stok berhasil ditambahkan!";
}

// Jika permintaan untuk tipe berdasarkan merk diterima
if (isset($_GET['get_tipes_for_merk'])) {
    $merkId = $_GET['get_tipes_for_merk'];
    
    // Mengambil tipe-tipe berdasarkan merk yang dipilih
    $stmt = $koneksi->prepare("SELECT id, nama_tipe FROM tipe WHERE id_merk = ?");
    $stmt->bind_param("i", $merkId);
    $stmt->execute();
    $tipes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Mengembalikan data dalam format JSON
    echo json_encode($tipes);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Sepatu</title>
    <link rel="stylesheet" href="resource/main.css">
</head>
<nav>
        <ul>
            <li><a href="tambah_stok.php">Tambah Stok Sepatu</a></li>
            <li><a href="lihat_stok.php">Lihat Stok</a></li>
            <!-- Anda bisa menambahkan lebih banyak item navbar di sini di masa mendatang -->
        </ul>
    </nav>
<body>
    <div class="container">
        <h2>Tambah Stok Sepatu</h2>
        
        <!-- Formulir Penambahan Stok -->
        <div class="add-form">
            <form action="tambah_stok.php" method="post">
                <!-- Pilihan Merk -->
                <label for="merk">Merk:</label>
                <select name="merk" id="merk">
                    <?php foreach ($all_merks as $merk): ?>
                        <option value="<?= $merk['id'] ?>"><?= $merk['nama_merk'] ?></option>
                    <?php endforeach; ?>
                </select>
                
                <!-- Pilihan Tipe -->
                <label for="tipe">Tipe:</label>
                <select name="tipe" id="tipe">
                    <?php foreach ($default_tipes as $tipe): ?>
                        <option value="<?= $tipe['id'] ?>"><?= $tipe['nama_tipe'] ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Input Harga -->
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" required>

                <!-- Input Ukuran -->
                <label for="ukuran">Ukuran:</label>
                <input type="number" name="ukuran" id="ukuran" step="0.1" required>

                <!-- Input Jumlah Stok -->
                <label for="jumlah_stok">Jumlah Stok:</label>
                <input type="number" name="jumlah_stok" id="jumlah_stok" required>

                <!-- Tombol Submit -->
                <input type="submit" name="add_stok" value="Tambah Stok">
            </form>
        </div>

        <!-- Skrip untuk memfilter tipe berdasarkan merk -->
        <script>
            document.getElementById('merk').addEventListener('change', function() {
                let merkId = this.value;
                
                // Menggunakan fetch untuk meminta tipe-tipe berdasarkan merk yang dipilih
                fetch(`tambah_stok.php?get_tipes_for_merk=${merkId}`)
                    .then(response => response.json())
                    .then(data => {
                        let tipeDropdown = document.getElementById('tipe');
                        tipeDropdown.innerHTML = ''; // Kosongkan dropdown tipe
                        
                        // Isi dropdown tipe dengan data yang diterima
                        data.forEach(tipe => {
                            let option = document.createElement('option');
                            option.value = tipe.id;
                            option.textContent = tipe.nama_tipe;
                            tipeDropdown.appendChild(option);
                        });
                    });
            });
        </script>
    </div>
</body>
</html>
