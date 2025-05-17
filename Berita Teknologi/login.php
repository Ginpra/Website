<?php
include 'koneksi.php'; 
session_start();

if(isset($_COOKIE['id']) && isset($_COOKIE['username'])) {
    $id = $_COOKIE['id'];
    $username = $_COOKIE['username'];
    
    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($username === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    if (mysqli_num_rows($result)) { // mysqli_num_rows() => melihat berapa data yang diambil dari $result
        $row = mysqli_fetch_assoc($result); 

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];

            if(isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60*60); // detik, menit, jam, hari, bulan
                setcookie('username', hash('sha256', $row['username']), time() + 60*60);
            }

            header("Location: dashboard.php");
            exit;
        };
    }

    echo "<script>
    alert('Username atau password salah min!');
    </script>";
}
    
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

  <nav class="navbar navbar-expand-lg navbar-custom fixed">
    <div class="container">
           <a class="navbar-brand" href="Home.php">
        <img src="gambar/lux.png" alt="Logo" style="width: 30px; height: auto;"> LuxTech
      </a>
      <a href="Home.php" class="btn btn-outline-warning btn-sm">Home</a>
    </div>
  </nav>

<body style="background-color: #111; color: yellow;">
  <div class="container py-5">
    <h2 class="text-center mb-4">Login Admin LuxTech</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="" method="POST" class="bg-dark p-4 rounded">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" class="form-control bg-secondary text-light" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control bg-secondary text-light" required>
          </div>
          <div class="mb-3">
           <input type="checkbox" name="remember" id="remember">
           <label for="remember">Remember Me</label>
          </div>
          <button type="submit" value="login" name="login" class="btn btn-warning w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
