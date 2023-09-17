<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Alat Pengukuran Sepatu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #007BFF;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar</h1>
        <?php
        // Koneksi ke database
        $host = 'localhost';
        $user = 'root'; // default user dari Laragon
        $pass = ''; // default password dari Laragon adalah kosong
        $db = 'sepatu';

        $koneksi = new mysqli($host, $user, $pass, $db);

        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Query pendaftaran
            $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', 'user')";
            if ($koneksi->query($query) === TRUE) {
                echo "Pendaftaran berhasil!";
            } else {
                echo "Terjadi kesalahan: " . $koneksi->error;
            }
        }

        ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <input class="btn btn-primary" type="submit" name="register" value="Daftar">
            <a href="utamafix.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
        </form>
    </div>
</body>
</html>
