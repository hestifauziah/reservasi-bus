<?php
session_start();
include 'db.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data reservasi milik user ini
$query = "
    SELECT r.*, b.nama_bus, b.tujuan, b.jadwal, b.harga 
    FROM reservasi r
    JOIN bus b ON r.id_bus = b.id
    WHERE r.user_id = '$user_id'
    ORDER BY r.tanggal_pesan DESC
";

$data = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan Saya</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Reservasi Bus Online</h1>
    <div style="text-align:right; margin-top:-30px;">
        Halo, <?= $_SESSION['nama']; ?> |
        <a href="index.php" class="btn">Beranda</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</header>

<section class="container">
    <h2>Riwayat Pemesanan Anda</h2>
    <?php if (mysqli_num_rows($data) == 0): ?>
        <p style="text-align:center;">Belum ada pesanan yang dibuat.</p>
    <?php else: ?>
    <table>
        <tr>
            <th>Nama Bus</th>
            <th>Tujuan</th>
            <th>Jadwal</th>
            <th>Jumlah Tiket</th>
            <th>Total Harga</th>
            <th>Tanggal Pesan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $row['nama_bus']; ?></td>
                <td><?= $row['tujuan']; ?></td>
                <td><?= $row['jadwal']; ?></td>
                <td><?= $row['jumlah_tiket']; ?></td>
                <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                <td><?= $row['tanggal_pesan']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php endif; ?>
</section>

<footer>
    <p>&copy; 2025 Reservasi Bus Online</p>
</footer>

</body>
</html>
