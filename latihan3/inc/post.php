<?php
const BUTUH_NAMA = 'Silakan masukkan nama barang';
const BUTUH_HARGA = 'Silakan masukkan harga';
const BUTUH_STOK = 'Silakan masukkan stok';

// sanitize and validate nama
$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
$inputs['nama'] = $nama;

if ($nama) {
    $nama = trim($nama);
    if ($nama === '') {
        $errors['nama'] = BUTUH_NAMA;
    }
} else {
    $errors['nama'] = BUTUH_NAMA;
}

// sanitize & validate harga
$harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_NUMBER_INT);
$inputs['harga'] = $harga;

if ($harga) {
    $harga = filter_var($harga, FILTER_VALIDATE_INT);
    if ($harga === false) {
        $errors['harga'] = BUTUH_HARGA;
    }
} else {
    $errors['harga'] = BUTUH_HARGA;
}

// sanitize & validate stok
$stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_NUMBER_INT);
$inputs['stok'] = $stok;

if ($stok) {
    $stok = filter_var($stok, FILTER_VALIDATE_INT);
    if ($stok === false) {
        $errors['stok'] = BUTUH_STOK;
    }
} else {
    $errors['stok'] = BUTUH_STOK;
}

// jika tidak ada error, simpan data barang
if (count($errors) == 0) {
    require_once __DIR__ . '/barang.php';
    $hasil = tambahBarang($nama, $harga, $stok);

    if (!$hasil) {
        echo "Gagal menyimpan, silakan diulang<br>";
        echo mysqli_error($koneksi) . "<br>";
    } else {
        echo "Berhasil menyimpan data";
    }

    $tujuan = htmlspecialchars($_SERVER['PHP_SELF']);
    echo "
        <form action='$tujuan'>
            <input type='submit' value='Kembali'>
        </form>
    ";
}
?>