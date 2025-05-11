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

// Ambil username admin dari database
$username = $_SESSION['username']; // Misal, session menyimpan username admin

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
    <h2 class="mb-4">Selamat datang, <?= $username ?></h2>
    <p>Di sini kamu bisa menambahkan, mengedit, atau menghapus data berita.</p>
    <a href="tambah.php" class="btn btn-warning">+ Tambah Berita</a>

    <h3 class="mt-4">Daftar Berita</h3>
    <?php
    // Ambil data berita dari database
    $query = "SELECT * FROM berita ORDER BY tanggal DESC";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $judul = htmlspecialchars($row['judul']);
        $sub = htmlspecialchars($row['sub']);
        $id = $row['id']; // Ambil id berita
    ?>
        <div class="card bg-dark text-light mt-4">
          <div class="card-body">
            <h5 class="card-title"><?= $judul ?></h5>
            <p class="card-text"><?= $sub ?></p>
            <a href="edit.php?id=<?= $id ?>" class="btn btn-outline-warning btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $id ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<p>Tidak ada berita untuk ditampilkan.</p>";
    }
    ?>
  </div>

</body>
</html>
