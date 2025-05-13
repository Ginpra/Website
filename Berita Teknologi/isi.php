<?php
include 'koneksi.php';

$id = $_GET['id'];

$sumber  = $conn->query("SELECT * FROM berita WHERE id = $id");
$data = $sumber->fetch_assoc();

$judul     = $data['judul'];
$deskripsi = nl2br($data['deskripsi']);
$gambar    = $data['gambar'] ? "gambar/".$data['gambar'] : "";
$tanggal   = $data['tanggal'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Isi Berita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

<body class="text-white" style="background:#111;">

  <nav class="navbar navbar-expand-lg navbar-custom fixed">
    <div class="container">
      <a class="navbar-brand" href="Home.php">
        <img src="gambar/lux.png" alt="Logo" style="width: 30px; height: auto;"> LuxTech
      </a>
      <div class="navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="Home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item ms-3">
            <a class="btn btn-outline-warning" href="login.php">Sign In</a>
          </li>
          <li class="nav-item ms-3">
            <a class="btn btn-warning" href="register.php">Sign Up</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center py-5">
    <h1><?= $judul ?></h1>
    <p class="text-secondary"><?= date('d M Y', strtotime($tanggal)) ?></p>

    <?php if ($gambar): ?>
      <img src="<?= $gambar ?>" class="custom-img img-fluid mx-auto d-block mb-4" alt="Gambar Berita" style="max-width: 30%; height: auto;">
    <?php endif; ?>

    <div class="text-justify mb-4"><?= $deskripsi ?></div>
  </div>

  <footer id="about" style="background-color: black; color: yellow;">
  <div class="container py-4"><br>
    <div class="row">

      <div class="col-md-4 mb-3">
        <h5>About LuxTech</h5>
        <p>LuxTech adalah portal berita teknologi terdepan yang menyajikan info gadget, AI, dan inovasi terkini.</p>
      </div>
        
      <div class="col-md-4 mb-3">
        <h5>Contact Us</h5>
        <ul class="list-unstyled">
          <li><img src="gambar/email.png" alt="" style="width: 20px; height: auto;"> :
          <a href="mailto:contact@luxtech.com" style="color: yellow;">contact@luxtech.com</a></li>
          <li><img src="gambar/phone.png" alt="" style="width: 20px; height: auto;"> :
          <a href="tel:+628123456789" style="color: yellow;">+62 812 3456 789</a></li>
          <li><img src="gambar/address.png" alt="" style="width: 20px; height: auto;"> : Jl. Babarsari, Yogyakarta</li>
        </ul>
      </div>

      <div class="col-md-4 mb-3">
        <h5>Follow Us</h5>
        <ul class="list-unstyled">
          <li>
            <img src="gambar/instagram.png" alt="" style="width: 20px; height: auto;"> :
            <a href="https://www.instagram.com/ginpra_017" style="color: yellow; text-decoration: none;">@ginpra_017</a>
          </li>
          <li>
            <img src="gambar/instagram.png" alt="" style="width: 20px; height: auto;"> :
            <a href="https://www.instagram.com/ydhuniel.k" style="color: yellow; text-decoration: none;">@ydhuniel.k</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="text-center pt-3">
      <small>© 2025 LuxTech. All rights reserved.</small>
    </div>
  </div>
</footer>

</body>
</html>
