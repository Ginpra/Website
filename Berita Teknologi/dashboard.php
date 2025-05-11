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

// Hapus berita
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $conn->prepare("DELETE FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}

// Update Berita
if (isset($_POST['update'])) {
    $id        = (int)$_POST['id'];
    $judul     = $_POST['judul'];
    $sub       = $_POST['sub'];
    $deskripsi = $_POST['deskripsi'];
    $kategori  = $_POST['kategori'];

    // Bangun query dasar
    $sql = "UPDATE berita SET
                judul     = '$judul',
                sub       = '$sub',
                deskripsi = '$deskripsi',
                kategori  = '$kategori'";

    $sql .= " WHERE id = $id";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header('Location: dashboard.php');
    exit;
}

// Ambil semua berita
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
    <h2 class="mb-4">Selamat datang, admin</h2>
    <p>Di sini kamu bisa menambahkan, mengedit, atau menghapus data berita.</p>
    <a href="tambah.php" class="btn btn-warning mb-4">+ Tambah Berita</a>

    <h3 class="text-warning">Daftar Berita</h3>
    <?php while ($row = $berita->fetch_assoc()): ?>
      <div class="bg-dark text-light p-3 rounded mb-3">
        <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
          <form method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-2">
              <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']) ?>" required>
            </div>
            <div class="mb-2">
              <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
            </div>
            <div class="mb-2">
              <input type="text" name="sub" class="form-control" value="<?= htmlspecialchars($row['sub']) ?>" required>
            </div>
            <div class="mb-2">
              <select name="kategori" class="form-select" required>
              <option value="hot">Hot News</option>
              <option value="latest">Latest News</option>
              <option value="tips">Tips</option>
            </select>
            </div>
            <button type="submit" name="update" class="btn btn-success btn-sm">Simpan</button>
            <a href="dashboard.php" class="btn btn-secondary btn-sm">Batal</a>
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
