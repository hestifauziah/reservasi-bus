<?php include 'db.php';
if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM reservasi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Reservasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>Edit Data Reservasi</h1>
</header>

<section class="container">
  <form method="post">
    <label>Nama Penumpang</label>
    <input type="text" name="nama_penumpang" value="<?= $row['nama_penumpang']; ?>" required>

    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>" required>

    <label>ID Bus</label>
    <input type="number" name="id_bus" value="<?= $row['id_bus']; ?>" required>

    <label>Jumlah Tiket</label>
    <input type="number" name="jumlah_tiket" value="<?= $row['jumlah_tiket']; ?>" required>

    <label>Total Harga</label>
    <input type="number" name="total_harga" value="<?= $row['total_harga']; ?>" required>

    <label>Tanggal Pesan</label>
    <input type="date" name="tanggal_pesan" value="<?= $row['tanggal_pesan']; ?>" required>

    <button type="submit" name="update" class="btn btn-simpan">Perbarui</button>
    <a href="index.php" class="btn">Kembali</a>
  </form>

  <?php
  if (isset($_POST['update'])) {
      $nama = $_POST['nama_penumpang'];
      $no_hp = $_POST['no_hp'];
      $id_bus = $_POST['id_bus'];
      $jumlah = $_POST['jumlah_tiket'];
      $total = $_POST['total_harga'];
      $tanggal = $_POST['tanggal_pesan'];

      $query = "UPDATE reservasi SET 
                nama_penumpang='$nama',
                no_hp='$no_hp',
                id_bus='$id_bus',
                jumlah_tiket='$jumlah',
                total_harga='$total',
                tanggal_pesan='$tanggal'
                WHERE id='$id'";
      mysqli_query($koneksi, $query);
      echo "<script>alert('Data berhasil diperbarui!');window.location='index.php';</script>";
  }
  ?>
</section>
</body>
</html>
