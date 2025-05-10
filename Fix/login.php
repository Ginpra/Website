<?php
// Jika sudah login, langsung ke dashboard
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - LuxTech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #111; color: yellow;">
  <div class="container py-5">
    <h2 class="text-center mb-4">Login Admin LuxTech</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="proses.php" method="POST" class="bg-dark p-4 rounded">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" class="form-control bg-secondary text-light" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control bg-secondary text-light" required>
          </div>
          <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
