<?php
session_start();
include 'db.php';

// pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// pastikan ada id bus
if (!isset($_GET['id'])) {
    echo "<script>alert('Bus tidak ditemukan!');window.location='index.php';</script>";
    exit;
}

$id_bus = $_GET['id'];
$bus = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM bus WHERE id='$id_bus'"));

if (!$bus) {
    echo "<script>alert('Bus tidak ditemukan!');window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Tiket - <?= $bus['nama_bus']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Reservasi Bus Online</h1>
    <div style="text-align:right; margin-top:-30px;">
        Halo, <?= $_SESSION['nama']; ?> | 
        <a href="logout.php" class="btn">Logout</a>
    </div>
</header>

<section class="container">
    <h2>Form Pemesanan Tiket</h2>
    <div class="bus-detail">
        <p><b>Nama Bus:</b> <?= $bus['nama_bus']; ?></p>
        <p><b>Tujuan:</b> <?= $bus['tujuan']; ?></p>
        <p><b>Harga Tiket:</b> Rp <?= number_format($bus['harga'], 0, ',', '.'); ?></p>
        <p><b>Jadwal:</b> <?= $bus['jadwal']; ?></p>
    </div>

    <form action="proses_reservasi.php" method="POST" class="form-container">
        <input type="hidden" name="id_bus" value="<?= $bus['id']; ?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

        <label>Nama Penumpang:</label>
        <input type="text" name="nama_penumpang" value="<?= $_SESSION['nama']; ?>" required>

        <label>No HP:</label>
        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required>

        <label>Jumlah Tiket:</label>
        <input type="number" name="jumlah_tiket" min="1" required>

        <button type="submit" class="btn">Pesan Sekarang</button>
    </form>

    <a href="index.php" class="btn" style="margin-top:15px;">Kembali</a>
</section>

<footer>
    <p>&copy; 2025 Reservasi Bus Online</p>
</footer>

</body>
</html>
