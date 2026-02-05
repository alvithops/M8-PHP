<!DOCTYPE html>
<html>

<head>
    <title>Latihan 2</title>
</head>

<body>

    <?php
    require_once 'koneksitoko.php';

    $koneksi = koneksiToko();
    if (!$koneksi) {
        die("Gagal Koneksi");
    }

    $sql = "CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama VARCHAR(40) NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    foto VARCHAR(70) NOT NULL DEFAULT ''
)";

    if (mysqli_query($koneksi, $sql)) {
        echo "Sukses menciptakan tabel barang";
    } else {
        echo "ERROR: Tidak dapat mengeksekusi $sql. " . mysqli_error($koneksi);
    }

    // Close connection
    mysqli_close($koneksi);
    ?>

</body>

</html>