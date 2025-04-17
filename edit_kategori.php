<?php include 'config.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori=$id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>
    <h2>Edit Kategori Barang</h2>
    <form method="post">
        Nama Kategori: <input type="text" name="nama_kategori" value="<?= $data['nama_kategori'] ?>" required>
        <button type="submit" name="submit">Update</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = trim($_POST['nama_kategori']);
        if ($nama != '') {
            mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori=$id");
            header("Location: kategori.php");
        } else {
            echo "<p style='color:red;'>Nama kategori tidak boleh kosong.</p>";
        }
    }
    ?>
</body>
</html>
