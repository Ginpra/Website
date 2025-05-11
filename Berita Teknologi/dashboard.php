<?php
include 'koneksi.php';
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Hapus berita
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM berita WHERE id = $id");
    header("Location: dashboard.php");
    exit;
}

// edit Berita
if (isset($_POST['edit'])) {
    $id        = $_POST['id'];
    $judul     = $_POST['judul'];
    $sub       = $_POST['sub'];
    $deskripsi = $_POST['deskripsi'];
    $kategori  = $_POST['kategori'];
    
    $baru = "UPDATE berita SET 
    judul     = '$judul',
    sub       = '$sub',
    deskripsi = '$deskripsi',
    kategori  = '$kategori'";

    $baru .= " WHERE id = $id";
    mysqli_query($conn, $baru) or die(mysqli_error($conn));
    header('Location: dashboard.php');
    exit;
}

$berita = $conn->query("SELECT * FROM berita");

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
    <a href="tambah.php" class="btn btn-warning mb-4">+ Tambah Berita</a>

    <h3 class="text-warning">Daftar Berita</h3>
    <?php while ($row = $berita->fetch_assoc()): ?>
      <div class="bg-dark text-light p-3 rounded mb-4">
        <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
          <form method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-4">
              <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']) ?>" required>
            </div>
            <div class="mb-4">
              <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
            </div>
            <div class="mb-4">
              <input type="text" name="sub" class="form-control" value="<?= htmlspecialchars($row['sub']) ?>" required>
            </div>
            <div class="mb-4">
              <select name="kategori" class="form-select" required>
              <option value="hot">Hot News</option>
              <option value="latest">Latest News</option>
              <option value="tips">Tips</option>
            </select>
            </div>
            <button type="submit" name="edit" class="btn btn-success btn-sm">Simpan</button>
            <a href="dashboard.php" class="btn btn-danger btn-sm">Batal</a>
          </form>
        <?php else: ?>
          <h5><?= htmlspecialchars($row['judul']) ?></h5>
          <p><?= htmlspecialchars($row['sub']) ?></p>
          <a href="?edit=<?= $row['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
          <a href="?hapus=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
