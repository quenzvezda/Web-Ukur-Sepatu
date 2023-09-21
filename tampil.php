<?php
include "includes/config.php";

$limit = 10; // jumlah data per halaman

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

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
    <?php include 'includes/navbar.php'; ?>
    <div class="container container-tampil">
        <h1>Daftar Stok Sepatu</h1>
        <form action="tampil.php" method="POST">
            <select name="merk">
                <option value="">Pilih Merk</option>
                <?php
                $merkQuery = $conn->query("SELECT * FROM merk");
                while($merk = $merkQuery->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$merk['id']}'>{$merk['nama_merk']}</option>";
                }
                ?>
            </select>
            <input type="submit" value="Cari">
        </form>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Jumlah Stok</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Cek apakah user memilih merk dari dropdown
                // Pindahkan definisi ini ke bagian atas
                $merkFilter = isset($_POST['merk']) && $_POST['merk'] != "" ? "WHERE merk = " . $_POST['merk'] : "";

                // Kemudian, Anda dapat menggunakan $merkFilter dalam query Anda
                $totalData = $conn->query("SELECT COUNT(*) FROM stok $merkFilter")->fetchColumn();
                $totalPages = ceil($totalData / $limit);

                $merkFilter = isset($_POST['merk']) && $_POST['merk'] != "" ? "WHERE s.merk = " . $_POST['merk'] : "";

                $stmt = $conn->prepare("SELECT s.id, t.nama_tipe, m.nama_merk, s.harga, s.ukuran, s.jumlah_stok FROM stok s 
                        JOIN tipe t ON s.tipe = t.id 
                        JOIN merk m ON s.merk = m.id 
                        $merkFilter 
                        LIMIT $limit OFFSET $offset");

                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama_merk']; ?></td>
                        <td><?php echo $row['nama_tipe']; ?></td>
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
        <?php
        echo "<div class='pagination'>";
        if ($totalData > $limit) {
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='tampil.php?page=$i'>$i</a> ";
            }
        }
        echo "</div>";       
        ?>
    </div>
</body>

</html>
