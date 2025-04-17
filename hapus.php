<?php
include 'config.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM barang WHERE id_barang=$id");
header("Location: index.php");
?>
