<?php
$host = 'localhost';
$db = 'sepatu';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

// Mengambil semua merk dari tabel merk
$stmtMerk = $pdo->prepare("SELECT id, nama_merk FROM merk");
$stmtMerk->execute();
$all_merks = $stmtMerk->fetchAll(PDO::FETCH_ASSOC);

$defaultMerkId = $all_merks[0]['id'];
$stmtDefaultTipe = $pdo->prepare("SELECT id, nama_tipe FROM tipe WHERE id_merk = ?");
$stmtDefaultTipe->execute([$defaultMerkId]);
$default_tipes = $stmtDefaultTipe->fetchAll(PDO::FETCH_ASSOC);

// Mengambil semua tipe dari tabel tipe
$stmtTipe = $pdo->prepare("SELECT id, nama_tipe FROM tipe");
$stmtTipe->execute();
$all_tipes = $stmtTipe->fetchAll(PDO::FETCH_ASSOC);

// Jika tombol 'add_stok' ditekan
if (isset($_POST['add_stok'])) {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $jumlah_stok = $_POST['jumlah_stok'];

    // Memasukkan data ke database
    $stmt = $pdo->prepare("INSERT INTO stok (tipe, merk, harga, ukuran, jumlah_stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$tipe, $merk, $harga, $ukuran, $jumlah_stok]);

    // Mengatur pesan sukses
    $message = "Stok berhasil ditambahkan!";
}

// Jika permintaan untuk tipe berdasarkan merk diterima
if (isset($_GET['get_tipes_for_merk'])) {
    $merkId = $_GET['get_tipes_for_merk'];
    
    // Mengambil tipe-tipe berdasarkan merk yang dipilih
    $stmt = $pdo->prepare("SELECT id, nama_tipe FROM tipe WHERE id_merk = ?");
    $stmt->execute([$merkId]);
    $tipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Mengembalikan data dalam format JSON
    echo json_encode($tipes);
    exit();
}

// Mendapatkan data stok dari database
$stmt = $pdo->prepare("
SELECT 
    stok.id, 
    merk.nama_merk AS merk_nama, 
    tipe.nama_tipe AS tipe_nama, 
    stok.harga, 
    stok.ukuran, 
    stok.jumlah_stok 
FROM stok
JOIN merk ON stok.merk = merk.id
JOIN tipe ON stok.tipe = tipe.id;
");
$stmt->execute();
$stok_data = $stmt->fetchAll();

$search_query = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $stmt = $pdo->prepare("SELECT * FROM stok WHERE merk LIKE ? OR tipe LIKE ? OR ukuran LIKE ?");
    $stmt->execute(["%$search_query%", "%$search_query%", "%$search_query%"]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM stok");
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stok Sepatu</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h2>Manajemen Stok Sepatu</h2>

        <!-- Pencarian -->
        <div class="search-container">
            <form action="editData.php" method="post">
                <input type="text" name="search" placeholder="Cari stok..." value="<?= htmlspecialchars($search_query) ?>">
                <button type="submit">Cari</button>
            </form>
        </div>

        <!-- Tabel Data Stok -->
        <table>
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Jumlah Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($stok_data as $stok): ?>
                    <tr>
                        <!-- <td><?= $stok['id'] ?></td> -->
                        <td><?= $stok['merk_nama'] ?></td>
                        <td><?= $stok['tipe_nama'] ?></td>
                        <td><?= $stok['harga'] ?></td>
                        <td><?= $stok['ukuran'] ?></td>
                        <td><?= $stok['jumlah_stok'] ?></td>
                        <td>
                            <!-- Tombol edit dan hapus akan ditempatkan di sini -->
                            <button>Edit</button>
                            <button>Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Formulir Penambahan Stok -->
        <div class="add-form">
            <h3>Tambah Stok</h3>
            <form action="editData.php" method="post">
                <!-- Pilihan Merk -->
                <label for="merk">Merk:</label>
                <select name="merk" id="merk">
                    <?php foreach ($all_merks as $merk): ?>
                        <option value="<?= $merk['id'] ?>"><?= $merk['nama_merk'] ?></option>
                    <?php endforeach; ?>
                </select>
                
                <!-- Pilihan Tipe -->
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
    </div>
    <!-- Skrip untuk memfilter tipe berdasarkan merk -->
    <script>
        document.getElementById('merk').addEventListener('change', function() {
            let merkId = this.value;
            
            // Menggunakan fetch untuk meminta tipe-tipe berdasarkan merk yang dipilih
            fetch(`editData.php?get_tipes_for_merk=${merkId}`)
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
</body>
</html>
