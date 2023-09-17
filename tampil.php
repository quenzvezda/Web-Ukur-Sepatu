<?php
include "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Stok Sepatu</title>
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
        <h1>Daftar Stok Sepatu</h1>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Jumlah Stok</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT s.id, t.nama_tipe, m.nama_merk, s.harga, s.ukuran, s.jumlah_stok FROM stok s 
                                        JOIN tipe t ON s.tipe = t.id 
                                        JOIN merk m ON s.merk = m.id");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama_tipe']; ?></td>
                        <td><?php echo $row['nama_merk']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['ukuran']; ?></td>
                        <td><?php echo $row['jumlah_stok']; ?></td>
                        <td>
                            <a href="operations/update.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
