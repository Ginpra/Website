<?php
include 'koneksi.php'; // Menghubungkan ke database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="styles.css">
</head>

<body>
    
<!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="Home.php">
        <img src="gambar/lux.png" alt="Logo" style="width: 30px; height: auto;"> LuxTech
      </a>
      <div class="navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#opening">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#hot-news">Hot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#latest-news">Latest</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tips-insight">Tips</a>
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

  <!-- Opening -->
<section id="opening" class="hero-section" style="
  background-image: url('gambar/nasa.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: white; ">
  <div>
    <h1>Welcome to LuxTech</h1>
    <h5>Your daily dose of the latest in technology, gadgets, and innovations!</h5> <br>
    <a href="#our-techs" class="btn btn-primary">Explore More</a>
  </div>
</section>

<!-- Our Touch -->
<section id="our-techs" class="py-5" style="background-color: black;">
  <div class="container text-center text-white"><br><br>
    <h2 class="mb-4">👥 Our Techs</h2>
    <div class="row justify-content-center g-4">
      
      <div class="col-md-5">
          <div class="creator-image">
            <img src="gambar/gilang.jpg" alt="Gilang" class="rounded-circle">
          </div>
          <div class="creator-info mt-3"><br>
            <h5>Gilang Andika Prasetyo</h5>
            <p>Manusia di balik fitur-fitur ciamik LuxTech.</p>
          </div>
        </div>

      <div class="col-md-5">
          <div class="creator-image">
            <img src="gambar/daniel.jpg" alt="Daniel" class="rounded-circle">
          </div>
          <div class="creator-info mt-3"><br>
            <h5>Daniel Roby Maldini</h5> 
            <p>Orang yang mengurus semua database LuxTech</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Hot News -->
<section id="hot-news" class="py-5" style="background-color: #111; color: yellow;">
  <div class="container"><br><br>
    <h2 class="mb-4">🔥 Hot News</h2>
    <?php

    $query = "SELECT * FROM berita WHERE kategori = 'hot' ORDER BY tanggal DESC LIMIT 6";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $judul = ($row['judul']);
        $sub = ($row['sub']);
        $gambar = !empty($row['gambar']) ? 'gambar/' . $row['gambar'] : 'default.jpg';
    ?>
        <div class="row mb-4 align-items-center">
          <div class="col-md-4">
            <img src="<?= $gambar ?>" alt="<?= $judul ?>" class="img-fluid rounded">
          </div>
          <div class="col-md-8">
            <a href="isi.php?id=<?= $row['id'] ?>" class="text-decoration-none text-warning">
              <h4><?= $judul ?></h4>
            </a>
            <p><?= $sub ?></p>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<p>Tidak ada berita hot untuk saat ini.</p>";
    }
    ?>
  </div>
</section>

<!-- Latest News -->
<section id="latest-news" class="py-5" style="background-color: #f8f9fa; color: #000;">
  <div class="container"><br><br>
    <h2 class="mb-4">📰 Latest News</h2>
    <div class="row">
      <?php
      $query = "SELECT * FROM berita WHERE kategori = 'latest' ORDER BY tanggal DESC";
      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $judul  = ($row['judul']);
          $sub    = ($row['sub']);
          $gambar = !empty($row['gambar']) ? 'gambar/' . $row['gambar'] : 'default.jpg';
      ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <img src="<?= $gambar ?>" class="card-img-top" alt="<?= $judul ?>">
              <div class="card-body">
                <a href="isi.php?id=<?= $row['id'] ?>" class="text-decoration-none text-black"><h5 class="card-title"><?= $judul ?></h5></a>
                <p class="card-text"><?= $sub ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>Tidak ada berita terbaru saat ini.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- Tips & Insight -->
<section id="tips-insight" class="py-5" style="background-color: #111; color: yellow;">
  <div class="container"><br><br>
    <h2 class="mb-4">💡 Tips & Insight</h2>
    <div class="row g-4">
      <?php
      $query = "SELECT * FROM berita WHERE kategori = 'tips' ORDER BY tanggal DESC";
      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $judul = ($row['judul']);
          $sub   = ($row['sub']);
      ?>
          <div class="col-md-6">
            <a href="isi.php?id=<?= $row['id'] ?>" class="text-decoration-none"><h5><?= $judul ?></h5></a>
            <p><?= $sub ?></p>
          </div>
      <?php
       }
      } else {
        echo "<p>Tidak ada tips atau insight saat ini.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- Footer -->
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