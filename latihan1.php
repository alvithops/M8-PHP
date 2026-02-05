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

    // 1. Menciptakan koneksi
    // Perbaikan: mysqli_connect biasanya butuh minimal 3 parameter
    $koneksi = mysqli_connect($servername, $username, $password);

    // 2. Cek koneksi
    if (!$koneksi) {
        // Perbaikan: mysqli_connect_error() digunakan untuk cek error koneksi awal
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // 3. Menciptakan database jika belum ada
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (mysqli_query($koneksi, $sql)) {
        echo "Berhasil menciptakan atau sudah ada database: $dbname <br>";
        
        // 4. Membuka/Memilih database
        $hasil = mysqli_select_db($koneksi, $dbname);
        if (!$hasil) {
            die("Gagal membuka database: " . mysqli_error($koneksi));
        } else {
            echo "Berhasil membuka database '$dbname'";
        }
    } else {
        // Perbaikan: mysqli_error($koneksi) butuh parameter koneksi
        die("Gagal buat database: " . mysqli_error($koneksi));
    }

    // Tutup koneksi (opsional tapi baik dilakukan)
    mysqli_close($koneksi);
    ?>
</body>
</html>