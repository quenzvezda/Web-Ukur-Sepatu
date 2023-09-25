<?php
include "includes/config.php";

$size = isset($_GET['size']) ? $_GET['size'] : null;

$products = [];

if ($size) {
    $stmt = $conn->prepare("SELECT s.*, m.nama_merk, t.nama_tipe FROM stok s 
                            JOIN merk m ON s.merk = m.id 
                            JOIN tipe t ON s.tipe = t.id 
                            WHERE s.ukuran = ?");
    $stmt->execute([$size]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Sepatu</title>
    <link rel="stylesheet" href="resource/main.css">
</head>
<body>
    <?php include 'includes/navbar-user.php'; ?>
    <div class="products-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="resource/template.jpg" alt="Sepatu" class="product-image">
                <div class="product-info">
                    <h3><?php echo $product['nama_tipe']; ?></h3>
                    <p>Merk: <?php echo $product['nama_merk']; ?></p>
                    <p>Harga: <?php echo $product['harga']; ?></p>
                    <p>Sisa Stok: <?php echo $product['jumlah_stok']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
