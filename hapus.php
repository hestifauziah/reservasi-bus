<?php
include 'db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM reservasi WHERE id='$id'");
  echo "<script>alert('Data berhasil dihapus!');window.location='index.php';</script>";
}
?>
