<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM bus WHERE id='$id'");
header("Location: admin_bus.php");
?>
