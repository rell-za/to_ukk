<?php
$host = "localhost";      // Ganti jika berbeda
$user = "root";           // Username MySQL
$pass = "";               // Password MySQL (kosongkan jika tidak pakai password)
$db   = "inventaris_barang";  // Nama database

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
