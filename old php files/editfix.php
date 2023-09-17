<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="cssfix.css">
    </head>

    <body>

        <div class="bagan">
            <h1>
                <strong>DATA SEPATU</strong>
            </h1>

            <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="tambah.html">Tambah Data</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="utama.html" tabindex="-1">Log Out</a>
                </li>
            </ul>

            <div class="search">
                <form action="POST">
                    <select name="list" class="select">
                        <option value="">Pilih Sepatu</option>
                        <option value="Adidas">Adidas</option>
                        <option value="Nike">Nike</option>
                        <option value="nb">New Balance</option>
                    </select>
                    <input type="submit" name="enter" value="cari" class="tombol">
                </form>
            </div>

            <table class="tabel1">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Merk</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Opsi</th>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="edatafix.php">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>[no]</td>
                    <td><div class="zoom"><img src="#" alt="">[Gambar]</div></td>
                    <td>[Merk]</td>
                    <td>[Ukuran]</td>
                    <td>[Harga]</td>
                    <td>[Stock]</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Hapus</a>
                    </td>
                </tr>
            </table>
        </div>

    </body>
</html>
