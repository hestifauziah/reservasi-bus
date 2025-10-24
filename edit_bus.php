<?php include 'db.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM bus WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Data Bus</h4>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Bus</label>
                    <input type="text" name="nama_bus" class="form-control" value="<?= $row['nama_bus']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tujuan</label>
                    <input type="text" name="tujuan" class="form-control" value="<?= $row['tujuan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jadwal</label>
                    <input type="date" name="jadwal" class="form-control" value="<?= $row['jadwal']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="admin_bus.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama_bus'];
    $tujuan = $_POST['tujuan'];
    $harga = $_POST['harga'];
    $jadwal = $_POST['jadwal'];

    mysqli_query($koneksi, "UPDATE bus SET nama_bus='$nama', tujuan='$tujuan', harga='$harga', jadwal='$jadwal' WHERE id='$id'");
    header("Location: admin_bus.php");
}
?>
</body>
</html>
