<?php
$host = 'localhost';
$db = 'sepatu';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

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
                    <th>ID</th>
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
                        <td><?= $stok['id'] ?></td>
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

        <!-- Formulir Tambah Stok -->
        <div class="add-form">
            <h3>Tambah Stok</h3>
            <form>
                <!-- Isi formulir untuk menambahkan stok baru akan ditempatkan di sini -->
            </form>
        </div>
    </div>
</body>
</html>
