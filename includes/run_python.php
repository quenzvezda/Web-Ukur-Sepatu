<?php
$message = '';
$panjang = '';
$lebar = '';

// Jalankan kode python
$output = shell_exec('python3 ../python/main.py');

// Baca dimensi dari file yang ditulis oleh skrip Python
if (file_exists('captured_dimensions.txt')) {
    $dimensions = file('captured_dimensions.txt', FILE_IGNORE_NEW_LINES);
    if (count($dimensions) >= 2) {
        $panjang = floatval($dimensions[1]) / 10;
        $lebar = floatval($dimensions[0]) / 10;
    }
}

// Mengembalikan hasil dalam format JSON
echo json_encode(['panjang' => $panjang, 'lebar' => $lebar]);

