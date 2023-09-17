<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        /* CSS untuk tampilan minimalis */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('/resource/bg-main.jpg');
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .button-container {
            display: flex;
            gap: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #ddd;
        }

        #login {
            background-color: #3498db;
            color: white;
        }

        #ukur {
            background-color: #2ecc71;
            color: white;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="login.php"><button id="login">Login</button></a>
        <a href="ukur.php"><button id="ukur">Ukur Kaki</button></a>
    </div>
</body>
</html>
