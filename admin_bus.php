<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Bus - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Kelola Data Bus</h4>
            <a href="tambah_bus.php" class="btn btn-light btn-sm">+ Tambah Bus</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Bus</th>
                        <th>Tujuan</th>
                        <th>Harga</th>
                        <th>Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM bus");
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama_bus']}</td>
                            <td>{$row['tujuan']}</td>
                            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                            <td>{$row['jadwal']}</td>
                            <td class='text-center'>
                                <a href='edit_bus.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='hapus_bus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus data ini?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
