<?php
include 'koneksi.php'; //menghubungkan file ini dengan file koneksi.php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['login'])) { //jika session login tidak ada
    header("Location: login.php"); //redirect ke halaman login
    exit; //keluar dari file ini
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - LuxTech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #111; color: yellow; padding-top: 70px;">

  <nav class="navbar navbar-dark bg-black fixed-top">
    <div class="container">
      <span class="navbar-brand text-warning">LuxTech Admin</span>
      <a href="?action=logout" class="btn btn-outline-warning btn-sm">Logout</a>
    </div>
  </nav>

  <div class="container py-5">
    <h2 class="mb-4">Selamat datang, admin</h2>
    <p>Di sini kamu bisa menambahkan, mengedit, atau menghapus data berita.</p>
    <a href="#" class="btn btn-warning">+ Tambah Berita</a>

    <h3 class="mt-4">Daftar Berita</h3>
    <div class="card bg-dark text-light mt-4">
      <div class="card-body">
        <h5 class="card-title">Judul Berita Teknologi</h5>
        <p class="card-text">Deskripsi singkat tentang berita.</p>
        <a href="#" class="btn btn-outline-warning btn-sm">Edit</a>
        <a href="#" class="btn btn-outline-danger btn-sm">Hapus</a>
      </div>
    </div>
  </div>
</body>
</html>
