<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="cssfix.css">
    </head>

    <body>
        <div class="bagan">
            <h1>Edit Data Sepatu</h1>
        </div>

        <div class="tambah">
            <form action="" method="post" onsubmit="">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Merk Sepatu</label>
                        <input type="text" name="merk" class="form-control" id="formGroupExampleInput" placeholder="Merk Sepatu" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Ukuran Sepatu</label>
                        <input type="text" name="ukuran" class="form-control" id="formGroupExampleInput2" placeholder="Ukuran Sepatu" value="" readonly>
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
                        <a class="btn btn-primary btn-lg" href="editfix.php" role="button">Kembali</a>
                    </div>
            </form>
        </div>
    </body>
</html>
