<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Cek apakah konfirasi password sesuai
    if ($password !== $password2) {
        echo "<script>
        alert('Input password tidak sesuai')
        </script>";
    } else {
        //misalnya password bener -> masukkin ke db

        //enkripsi
        $password = password_hash($password, PASSWORD_DEFAULT);

        //masukkkin ke db
        $query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')"; 
        $q = mysqli_query($conn, $query);

        if ($q) {
            echo "<script>
            alert('admin berhasil ditambahkan')
            </script>";
        } else {
            echo "<script>
            alert('admin gagal ditambahkan')
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Admin - LuxTech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #111; color: yellow;">
  <div class="container py-5">
    <h2 class="text-center mb-4">Register Admin LuxTech</h2>
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
            <label for="password2" class="form-label">Konfirmasi Password</label>
            <input id="password2" type="password" name="password2" class="form-control bg-secondary text-light" required>
          </div>
          <button type="submit" value="register" name="register" class="btn btn-warning w-100">Register</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
