<h2>ISI BARANG</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <div>
        <label for="nama">Nama Barang:</label><br>
        <input type="text" name="nama" id="nama" value="<?php echo isset($inputs['nama']) ? $inputs['nama'] : '' ?>"><br>
        <small><?php echo isset($errors['nama']) ? $errors['nama'] : '' ?></small>
    </div>
    <div>
        <label for="nama">Harga Jual:</label><br>
        <input type="text" name="harga" id="harga"
            value="<?php echo isset($inputs['harga']) ? $inputs['harga'] : '' ?>"><br>
        <small><?php echo isset($errors['harga']) ? $errors['harga'] : '' ?></small>
    </div>
    <div>
        <label for="nama">Stok:</label><br>
        <input type="text" name="stok" id="stok" value="<?php echo isset($inputs['stok']) ? $inputs['stok'] : '' ?>"><br>
        <small><?php echo isset($errors['stok']) ? $errors['stok'] : '' ?></small>
    </div>
    <div>
        <input type="submit" name="proses" value="Simpan">
        <input type="reset" name="reset" value="Reset">
    </div>
</form>