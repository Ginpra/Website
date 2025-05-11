<?php
include 'koneksi.php';

// Jika tombol “Tambah” diklik
if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $judul        = $conn->real_escape_string($_POST['title']);
    $deskripsi    = $conn->real_escape_string($_POST['description']);
    $url_gambar   = trim($_POST['image_url']);
    $url_gambar   = $url_gambar !== '' 
                    ? $conn->real_escape_string($url_gambar) 
                    : null;
    $kategori     = in_array($_POST['category'], ['hot','latest','tips'])
                    ? $_POST['category'] 
                    : 'latest';
    $tgl_publish  = $_POST['publish_date']; // format YYYY-MM-DD

    // Siapkan query INSERT
    $sql = "INSERT INTO berita
            (title, description, image_url, category, publish_date)
            VALUES
            ('$judul', '$deskripsi', "
            . ($url_gambar ? "'$url_gambar'" : "NULL") .
            ", '$kategori', '$tgl_publish')";

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
  <title>Tambah Berita - LuxTech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #111; color: yellow;">

  <div class="container py-5">
    <h2 class="text-center mb-4">Tambah Berita Baru</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="" method="POST" class="bg-dark p-4 rounded">
          <!-- Judul Berita -->
          <div class="mb-3">
            <label for="title" class="form-label">Judul Berita</label>
            <input id="title" type="text" name="title"
                   class="form-control bg-secondary text-light" required>
          </div>
          <!-- Deskripsi Berita -->
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                      class="form-control bg-secondary text-light" required></textarea>
          </div>
          <!-- URL Gambar (opsional) -->
          <div class="mb-3">
            <label for="image_url" class="form-label">URL Gambar <small>(opsional)</small></label>
            <input id="image_url" type="text" name="image_url"
                   class="form-control bg-secondary text-light"
                   placeholder="https://example.com/gambar.jpg">
          </div>
          <!-- Kategori -->
          <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select id="category" name="category"
                    class="form-select bg-secondary text-light" required>
              <option value="hot">Hot News</option>
              <option value="latest">Latest News</option>
              <option value="tips">Tips</option>
            </select>
          </div>
          <!-- Tanggal Publikasi -->
          <div class="mb-3">
            <label for="publish_date" class="form-label">Tanggal Publikasi</label>
            <input id="publish_date" type="date" name="publish_date"
                   class="form-control bg-secondary text-light" required>
          </div>
          <!-- Tombol Submit -->
          <button type="submit" name="tambah"
                  class="btn btn-warning w-100">Tambah Berita</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
