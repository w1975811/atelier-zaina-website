<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$host = "localhost";
$dbname = "atelbkcg_enquiries";
$username = "atelbkcg_atelier_admin";
$password = "28DcN@2LyjWpC5j";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, event_date, message, 
created_at FROM enquiries ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard | Atelier Zaina</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .dashboard-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #fffdfd;
      border-radius: 12px;
      overflow: hidden;
    }

    .dashboard-table th,
    .dashboard-table td {
      border: 1px solid #dfd2cb;
      padding: 12px;
      text-align: left;
      vertical-align: top;
    }

    .dashboard-table th {
      background: #f3e3e6;
    }

    .dashboard-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      gap: 16px;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container header-inner">
      <a class="brand" href="../index.html">
        <img src="../images/logo.png" alt="Atelier Zaina logo" class="logo" />
        <span class="brand-name">Atelier Zaina</span>
      </a>

      <nav class="nav">
        <a href="../index.html">View Site</a>
        <a href="logout.php">Logout</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="contact-hero">
      <h1>Admin Dashboard</h1>
      <p>View customer enquiries submitted through the website.</p>
    </section>

    <section class="card" style="margin-bottom: 60px;">
      <div class="dashboard-actions">
        <h2 style="margin: 0;">Enquiries</h2>
      </div>

      <?php if ($result && $result->num_rows > 0): ?>
        <table class="dashboard-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Event Date</th>
              <th>Message</th>
              <th>Submitted</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No enquiries found.</p>
      <?php endif; ?>
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
<?php
$conn->close();
?>