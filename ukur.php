<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $db = 'sepatu';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass);

        $panjang = $_POST['panjang'];
        $lebar = $_POST['lebar'];

        $stmt = $pdo->prepare("INSERT INTO buffer (panjang, lebar, waktu) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $stmt->execute([$panjang, $lebar]);

        $message = 'Data berhasil disimpan!';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Fungsi untuk mendapatkan ukuran sepatu berdasarkan panjang kaki
function getShoeSize($panjang) {
    $sizes = [
        '35' => 22.8,
        '35.5' => 23.1,
        '36' => 23.5,
        '37' => 23.8,
        '37.5' => 24.1,
        '38' => 24.5,
        '38.5' => 24.8,
        '39' => 25.1,
        '40' => 25.4,
        '41' => 25.7,
        '42' => 26,
        '43' => 26.7,
        '44' => 27.3,
        '45' => 27.9,
        '46.5' => 28.6,
        '48' => 29.2
    ];

    foreach ($sizes as $size => $length) {
        if ($panjang <= $length) {
            return $size;
        }
    }
    return "Ukuran sepatu tidak tersedia";
}

$shoeSize = isset($panjang) ? getShoeSize($panjang) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukur Kaki</title>
    <link rel="stylesheet" href="resource/main.css">
</head>
<body>
    <div class="container">
        <h2>Ukur Kaki</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="ukur.php" method="post">
            <label for="panjang">Panjang:</label>
            <input type="number" step="0.01" name="panjang" required>
            <label for="lebar">Lebar:</label>
            <input type="number" step="0.01" name="lebar" required>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <div class="container">
        <h2>Ukuran Sepatu</h2>
        <?php if ($shoeSize): ?>
            <p>Ukuran sepatu yang disarankan: <?php echo $shoeSize; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
