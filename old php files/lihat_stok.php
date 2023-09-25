<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Stok Sepatu</title>
    <link rel="stylesheet" href="resource/main.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="tambah_stok.php">Tambah Stok Sepatu</a></li>
            <li><a href="lihat_stok.php">Lihat Stok</a></li>
            <!-- Anda bisa menambahkan lebih banyak item navbar di sini di masa mendatang -->
        </ul>
    </nav>

    <div class="container">
        <h1>Daftar Stok Sepatu</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT s.id, t.nama_tipe, m.nama_merk, s.harga, s.ukuran, s.jumlah_stok 
                          FROM stok s 
                          JOIN merk m ON s.merk = m.id 
                          JOIN tipe t ON s.tipe = t.id";
                $hasil = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($hasil)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['nama_tipe']."</td>";
                    echo "<td>".$row['nama_merk']."</td>";
                    echo "<td>".$row['harga']."</td>";
                    echo "<td>".$row['ukuran']."</td>";
                    echo "<td>".$row['jumlah_stok']."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
