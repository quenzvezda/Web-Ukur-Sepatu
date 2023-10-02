<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukur Kaki</title>
    <link rel="stylesheet" href="resource/main.css">
</head>
<body>
    <?php include 'includes/navbar-user.php'; ?>
    <div class="container">
        <h2>Ukur Kaki</h2>
        
        <p>Panjang: <span id="panjang">Mengukur...</span></p>
        <p>Lebar: <span id="lebar">Mengukur...</span></p>
        
        <h2>Ukuran Sepatu</h2>
        <p>Ukuran sepatu yang disarankan: <span id="shoeSize">Mengukur...</span></p>
        <a href="#" id="shoeLink" class="btn btn-primary">Lihat Stok Sepatu</a>
    </div>

    <script>
        function getShoeSize(panjang) {
            const sizes = {
                '35': 22.8,
                '35.5': 23.1,
                '36': 23.5,
                '37': 23.8,
                '37.5': 24.1,
                '38': 24.5,
                '38.5': 24.8,
                '39': 25.1,
                '40': 25.4,
                '41': 25.7,
                '42': 26,
                '43': 26.7,
                '44': 27.3,
                '45': 27.9,
                '46.5': 28.6,
                '48': 29.2
            };

            for (let size in sizes) {
                if (panjang <= sizes[size]) {
                    return size;
                }
            }
            return "Ukuran sepatu tidak tersedia";
        }

        window.onload = function() {
            alert("Silahkan Letakkan Kaki Anda!");
            
            // Setelah pengguna mengklik OK, jalankan AJAX untuk menjalankan Python
            fetch('includes/run_python.php')
            .then(response => response.json())
            .then(data => {
                if (data.panjang && data.lebar) {  // Jika ada data panjang dan lebar
                    document.getElementById('panjang').textContent = data.panjang + " cm";
                    document.getElementById('lebar').textContent = data.lebar + " cm";
                    const shoeSize = getShoeSize(data.panjang);
                    document.getElementById('shoeSize').textContent = shoeSize;
                    document.getElementById('shoeLink').href = `beli.php?size=${shoeSize}`;

                    // Kirim data ke save_measurement.php melalui request POST
                    fetch('includes/save_measurement.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `panjang=${data.panjang}&lebar=${data.lebar}`
                    });
                } else {  // Jika tidak ada data (pengukuran gagal)
                    document.getElementById('panjang').textContent = "Pengukuran gagal";
                    document.getElementById('lebar').textContent = "Pengukuran gagal";
                    document.getElementById('shoeSize').textContent = "Pengukuran gagal";
                }
            });
        };
    </script>

</body>
</html>
