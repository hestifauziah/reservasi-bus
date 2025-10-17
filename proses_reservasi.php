<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$nama = $_POST['nama_penumpang'];
$nohp = $_POST['no_hp'];
$id_bus = $_POST['id_bus'];
$jumlah = $_POST['jumlah_tiket'];
$user_id = $_SESSION['user_id'];

$bus = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM bus WHERE id=$id_bus"));
$total = $bus['harga'] * $jumlah;

$query = "INSERT INTO reservasi (nama_penumpang, no_hp, id_bus, jumlah_tiket, total_harga)
          VALUES ('$nama', '$nohp', '$id_bus', '$jumlah', '$total')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Reservasi berhasil! Total: Rp " . number_format($total, 0, ',', '.') . "');window.location='data_reservasi.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
