<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Inventaris</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Data Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="tambah.php">Tambah Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="kategori.php">Kategori</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Tambah -->
    <div class="container mt-4">
        <h3>Tambah Barang</h3>
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang">
            </div>

            <div class="col-md-6">
                <label for="kategori_barang" class="form-label">Kategori Barang</label>
                <select class="form-select" name="kategori_barang" id="kategori_barang" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                    while ($k = mysqli_fetch_assoc($kategori)) {
                        echo "<option value='" . $k['nama_kategori'] . "'>" . $k['nama_kategori'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                <input type="number" class="form-control" name="jumlah_stok" id="jumlah_stok">
            </div>

            <div class="col-md-4">
                <label for="harga_barang" class="form-label">Harga Barang</label>
                <input type="number" step="0.01" class="form-control" name="harga_barang" id="harga_barang">
            </div>

            <div class="col-md-4">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk">
            </div>

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $nama = trim($_POST['nama_barang']);
            $kategori = $_POST['kategori_barang'];
            $stok = $_POST['jumlah_stok'];
            $harga = $_POST['harga_barang'];
            $tanggal = $_POST['tanggal_masuk'];

            $errors = [];

            if ($nama == '') {
                $errors[] = "Nama barang tidak boleh kosong.";
            }

            if ($kategori == '') {
                $errors[] = "Kategori harus dipilih.";
            }

            if (!is_numeric($stok) || $stok < 0) {
                $errors[] = "Jumlah stok harus berupa angka dan tidak boleh negatif.";
            }

            if (!is_numeric($harga) || $harga < 0) {
                $errors[] = "Harga barang harus berupa angka dan tidak boleh negatif.";
            }

            if (empty($errors)) {
                mysqli_query($conn, "INSERT INTO barang (nama_barang, kategori_barang, jumlah_stok, harga_barang, tanggal_masuk)
                                     VALUES ('$nama', '$kategori', $stok, $harga, '$tanggal')");
                echo "<div class='alert alert-success mt-3'>Data barang berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'><ul>";
                foreach ($errors as $e) {
                    echo "<li>$e</li>";
                }
                echo "</ul></div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
