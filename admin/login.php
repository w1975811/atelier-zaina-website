<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple hardcoded admin login for the project
    $adminUser = 'admin';
    $adminPass = 'AtelierZaina2026!';

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login | Atelier Zaina</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header class="site-header">
    <div class="container header-inner">
      <a class="brand" href="../index.html">
        <img src="../images/logo.png" alt="Atelier Zaina logo" class="logo" />
        <span class="brand-name">Atelier Zaina</span>
      </a>
    </div>
  </header>

  <main class="container">
    <section class="contact-hero">
      <h1>Admin Login</h1>
      <p>Authorised access only.</p>
    </section>

    <section class="card" style="max-width: 600px; margin: 0 auto 60px;">
      <h2>Sign In</h2>

      <?php if ($error): ?>
        <p class="status"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>

      <form method="POST" class="form">
        <div class="form-grid" style="grid-template-columns: 1fr;">
          <div class="field">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
          </div>
        </div>

        <button type="submit">Log In</button>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-inner">
      <p>© <span id="year"></span> Atelier Zaina</p>
      <div class="footer-links">
        <a href="https://www.instagram.com/atelierzaina/" target="_blank">
  <img src="../images/instagram.png" alt="Instagram" class="social-icon">
</a>

<a href="https://www.tiktok.com/@atelierzaina" target="_blank">
  <img src="../images/tiktok.png" alt="TikTok" class="social-icon tiktok-icon">
</a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>