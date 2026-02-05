<!DOCTYPE html>
<html>

<head>
    <title>Menciptakan Database</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "toko";
    // menciptakan koneksi
    $koneksi = mysqli_connect($servername, $username, $password);
    // Cek koneksi
    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_error());
    }
    $db = mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS $dbname");
    if (!$db)
        die("Gagal buat database");
    else {
        echo "Berhasil menciptakan database<br>";
        $hasil = mysqli_select_db($koneksi, $dbname);
        if (!$hasil)
            die("Gagal buat database");
        else
            echo "Berhasil membuka database";
    }
    ?>
</body>

</html>