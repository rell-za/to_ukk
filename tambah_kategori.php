<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>
    <h2>Tambah Kategori Barang</h2>
    <form method="post">
        Nama Kategori: <input type="text" name="nama_kategori" required>
        <button type="submit" name="submit">Simpan</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = trim($_POST['nama_kategori']);
        if ($nama != '') {
            mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
            header("Location: kategori.php");
        } else {
            echo "<p style='color:red;'>Nama kategori tidak boleh kosong.</p>";
        }
    }
    ?>
</body>
</html>
