<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Kategori Barang</title>
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
                    <li class="nav-item"><a class="nav-link" href="tambah.php">Tambah Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="kategori.php">Kategori</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        <h3>Manajemen Kategori Barang</h3>

        <!-- Form tambah kategori -->
        <form method="post" class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
            </div>
            <div class="col-md-6 align-self-end">
                <button type="submit" name="submit" class="btn btn-primary">Tambah Kategori</button>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $nama_kategori = trim($_POST['nama_kategori']);
            if ($nama_kategori != '') {
                // Cek duplikat
                $cek = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori'");
                if (mysqli_num_rows($cek) == 0) {
                    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
                    echo "<div class='alert alert-success'>Kategori berhasil ditambahkan.</div>";
                } else {
                    echo "<div class='alert alert-warning'>Kategori sudah ada.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Nama kategori tidak boleh kosong.</div>";
            }
        }

        // Hapus kategori
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");
            echo "<div class='alert alert-success'>Kategori berhasil dihapus.</div>";
        }
        ?>

        <!-- Tabel kategori -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                $no = 1;
                while ($row = mysqli_fetch_assoc($kategori)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>
                            <a href='?hapus={$row['id_kategori']}' onclick=\"return confirm('Yakin hapus kategori ini?')\" class='btn btn-danger btn-sm'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
