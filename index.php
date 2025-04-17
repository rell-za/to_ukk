<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Inventaris</title>
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
                    <li class="nav-item"><a class="nav-link" href="kategori.php">Kategori</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Data Inventaris Barang</h3>

        <!-- Pencarian dan Filter -->
        <form method="get" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama barang..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
            </div>
            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    <?php
                    $kategori_result = mysqli_query($conn, "SELECT DISTINCT kategori_barang FROM barang");
                    while ($kategori = mysqli_fetch_assoc($kategori_result)) {
                        $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $kategori['kategori_barang']) ? "selected" : "";
                        echo "<option value='{$kategori['kategori_barang']}' $selected>{$kategori['kategori_barang']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-primary me-2">Cari</button>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Tabel -->
        <table class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah Stok</th>
                    <th>Harga</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $where = [];

            if (!empty($_GET['search'])) {
                $search = mysqli_real_escape_string($conn, $_GET['search']);
                $where[] = "nama_barang LIKE '%$search%'";
            }

            if (!empty($_GET['kategori'])) {
                $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);
                $where[] = "kategori_barang = '$kategori'";
            }

            $where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";
            $result = mysqli_query($conn, "SELECT * FROM barang $where_sql ORDER BY id_barang DESC");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['kategori_barang']}</td>
                        <td>{$row['jumlah_stok']}</td>
                        <td>Rp" . number_format($row['harga_barang'], 2, ',', '.') . "</td>
                        <td>{$row['tanggal_masuk']}</td>
                        <td>
                            <a href='edit.php?id={$row['id_barang']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus.php?id={$row['id_barang']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Data tidak ditemukan</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
