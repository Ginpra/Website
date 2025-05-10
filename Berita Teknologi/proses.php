<?php
session_start();
// Hardcoded credentials
$valid_username = 'admin';
$valid_password = '123';

// Ambil input
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['admin'] = true;
    header('Location: dashboard.php');
    exit();
} else {
    echo "<script>
      alert('Login gagal! Username atau password salah.');
      window.location.href = 'login.php';
    </script>";
    exit();
}
