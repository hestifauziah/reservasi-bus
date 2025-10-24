<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Reservasi Bus</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>Data Reservasi Bus</h1>
</header>

<section class="container">
  <a href="tambah.php" class="btn btn-tambah">+ Tambah Reservasi</a>
  <table>
    <tr>
      <th>No</th>
      <th>Nama Penumpang</th>
      <th>No HP</th>
      <th>Bus</th>
      <th>Tujuan</th>
      <th>Jumlah Tiket</th>
      <th>Total Harga</th>
      <th>Tanggal Pesan</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $query = "SELECT r.*, b.nama_bus, b.tujuan 
              FROM reservasi r 
              JOIN bus b ON r.id_bus = b.id";
    $data = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
          <td>$no</td>
          <td>{$row['nama_penumpang']}</td>
          <td>{$row['no_hp']}</td>
          <td>{$row['nama_bus']}</td>
          <td>{$row['tujuan']}</td>
          <td>{$row['jumlah_tiket']}</td>
          <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
          <td>{$row['tanggal_pesan']}</td>
          <td>
            <a href='edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
            <a href='hapus.php?id={$row['id']}' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
          </td>
        </tr>";
        $no++;
    }
    ?>
  </table>
</section>
</body>
</html>
