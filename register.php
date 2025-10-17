<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah digunakan!');window.location='register.php';</script>";
    } else {
        mysqli_query($koneksi, "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')");
        echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="bus.css">
</head>
<body>
<div class="container">
    <h2>Daftar Akun Baru</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
