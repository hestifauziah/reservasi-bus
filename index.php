<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <title>Reservasi Bus Online</title>
    <link rel="stylesheet" href="bus.css">
</head>
<body>
    <header>
        <h1>Reservasi Bus Online</h1>
    </header>

    <section class="container">
        <h2>Daftar Bus Tersedia</h2>
        <table>
            <tr>
                <th>Nama Bus</th>
                <th>Tujuan</th>
                <th>Harga</th>
                <th>Jadwal</th>
                <th>Aksi</th>
            </tr>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM bus");
            while ($row = mysqli_fetch_assoc($data)) {
                echo "<tr>
                    <td>{$row['nama_bus']}</td>
                    <td>{$row['tujuan']}</td>
                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td>{$row['jadwal']}</td>
                    <td><a href='?pesan={$row['id']}' class='btn'>Pesan</a></td>
                </tr>";
            }
            ?>
        </table>

        <?php if (isset($_GET['pesan'])): 
            $id_bus = $_GET['pesan'];
            $bus = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM bus WHERE id=$id_bus"));
        ?>
        <div class="form-container">
            <h2>Form Reservasi - <?= $bus['nama_bus']; ?></h2>
            <form action="proses_reservasi.php" method="POST">
                <input type="hidden" name="id_bus" value="<?= $bus['id']; ?>">
                <label>Nama Penumpang:</label>
                <input type="text" name="nama_penumpang" required>

                <label>No HP:</label>
                <input type="text" name="no_hp" required>

                <label>Jumlah Tiket:</label>
                <input type="number" name="jumlah_tiket" min="1" required>

                <button type="submit" class="btn">Pesan Sekarang</button>
            </form>
        </div>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 Reservasi Bus Online</p>
    </footer>
</body>
</html>
