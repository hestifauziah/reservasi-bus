<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: data_reservasi.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<script>alert('Email atau password salah!');window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="bus.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <label>Email:</label>
        <input type="text" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>
