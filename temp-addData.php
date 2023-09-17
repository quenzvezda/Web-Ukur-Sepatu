<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $db = 'sepatu';
    $user = 'root'; // Ganti dengan username database Anda
    $pass = ''; // Ganti dengan password database Anda
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit database</title>
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
</body>
</html>
