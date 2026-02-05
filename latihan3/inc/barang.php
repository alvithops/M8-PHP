<?php
require_once __DIR__ . '/koneksitoko.php';
function tambahBarang($nama, $harga, $stok)
{
    $koneksi = koneksiToko();
    $sql = "insert into barang(nama,harga,stok) values
('$nama',$harga,$stok)";
    $hasil = mysqli_query($koneksi, $sql);
    if ($hasil) {
        return true;
    } else {
        return false;
        ;
    }
}