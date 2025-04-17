<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori=$id");
header("Location: kategori.php");
?>
