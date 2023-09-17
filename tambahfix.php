<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="cssfix.css">
    </head>

    <body>
        <h1>Tambah Data Sepatu</h1>

        <div class="tambah">
            <form action="ptambah.php" method="post" enctype="multipart/form-data" onsubmit="">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Merk Sepatu</label><br>
                    <select name="daftar" class="pilih" id="">
                        <option value="adidas">Adidas</option>
                        <option value="nike">Nike</option>
                        <option value="nb">New Balance</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Ukuran Sepatu</label>
                    <input type="text" name="ukuran" class="form-control" id="formGroupExampleInput2" placeholder="Ukuran Sepatu" value="">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Stok</label>
                    <input type="text" name="stok" class="form-control" id="formGroupExampleInput2" placeholder="Stok" value="">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Harga</label>
                    <input type="text" name="harga" class="form-control" id="formGroupExampleInput2" placeholder="Harga" value="">
                </div>
    
                <div class="tombol">
                        <input type="submit" class="btn btn-primary btn-lg" value="Simpan">
                        <a class="btn btn-primary btn-lg" href="edit.html" role="button">Kembali</a>
                </div>
            </form>
        </div>
    </body>
</html>
