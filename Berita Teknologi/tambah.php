<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judul       = ($_POST['judul']);
    $deskripsi   = ($_POST['deskripsi']);
    $sub       = ($_POST['sub']);
    $kategori    = in_array($_POST['kategori'], ['hot','latest','tips']) ? $_POST['kategori'] : 'latest';
    $tanggal = $_POST['tanggal'];

    // Tangani upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $tmp   = $_FILES['gambar']['tmp_name'];
        $ext   = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $izin  = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $izin)) {
            // Buat nama unik dan pindahkan
            $gambar = uniqid('img_') . '.' . $ext;
            $tujuan = __DIR__ . '/gambar/' . $gambar;
            move_uploaded_file($tmp, $tujuan);
        }
    }

    // Siapkan query INSERT
    $sql = "INSERT INTO berita 
            (judul, sub, deskripsi, gambar, kategori, tanggal)
            VALUES
            ('$judul', '$sub', '$deskripsi', "
            . ($gambar ? "'$gambar'" : "NULL") .
            ", '$kategori', '$tanggal')";

    if ($conn->query($sql)) {
        echo "<script>
                alert('Berita berhasil ditambahkan!');
                window.location.href='dashboard.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan berita: " . addslashes($conn->error) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Berita - LuxTech</title>
  
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  </head>

<body style="background-color: #111; color: yellow;">

  <nav class="navbar navbar-expand-lg navbar-custom fixed">
    <div class="container">
           <a class="navbar-brand" href="Home.php">
        <img src="gambar/lux.png" alt="Logo" style="width: 30px; height: auto;"> LuxTech Admin
      </a>
      <a href="dashboard.php" class="btn btn-outline-warning btn-sm">Kembali</a>
    </div>
  </nav>

  <div class="container py-5" style="padding-top: 100px;">
    <h2 class="text-center mb-4">Form Tambah Berita</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="" method="POST" enctype="multipart/form-data" class="bg-dark p-4 rounded">

          <!-- Judul Berita -->
          <div class="mb-3">
            <label class="form-label">Judul Berita</label>
            <input type="text" name="judul" class="form-control bg-secondary text-light" required>
          </div>

          <!-- Sub Judul -->
          <div class="mb-3">
            <label class="form-label">Sub Judul</label>
            <input type="text" name="sub" class="form-control bg-secondary text-light" required>
          </div>

          <!-- Deskripsi -->
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea  name="deskripsi"  rows="4"  class="form-control bg-secondary text-light"  required></textarea>
          </div>

          <!-- Upload Gambar -->
          <div class="mb-3">
            <label class="form-label">Pilih Gambar <small>(opsional)</small></label>
            <input type="file" name="gambar" accept="image/*" class="form-control bg-secondary text-light">
          </div>

          <!-- Kategori -->
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select bg-secondary text-light" required>
              <option value="hot">Hot News</option>
              <option value="latest">Latest News</option>
              <option value="tips">Tips</option>
            </select>
          </div>
          
          <!-- Tanggal Publikasi -->
          <div class="mb-3">
            <label class="form-label">Tanggal Publikasi</label>
            <input type="date" name="tanggal" class="form-control bg-secondary text-light" required>
          </div>

          <!-- Tombol Submit -->
          <button type="submit" name="tambah" class="btn btn-warning w-100"> Tambah Berita
          </button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
