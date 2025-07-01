<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login_bootstrap.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_credentials'])) {
  $new_username = $_POST['new_username'];
  $new_password = $_POST['new_password'];

  $new_data = [
    'username' => $new_username,
    'password' => $new_password
  ];

  // Simpan ke file user.json
  file_put_contents('user.json', json_encode($new_data));

  $_SESSION['username'] = $new_username;
  $update_message = "Username dan Password berhasil diperbarui!";
}
?>


<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Example · Bootstrap</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .chart-container {
        position: relative;
        width: 100%;
        max-width: 900px;
        height: 380px;
        margin: auto;
      }
    </style>
  </head>
  <body>
    
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">My Dashboard</a>
  <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
          aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text"
         placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file" class="align-text-bottom"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
              Customers
            </a>
            <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
              Reports
            </a>
            <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
              Integrations
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
  <span>Saved reports</span>
  <a class="link-secondary" href="#" aria-label="Add a new report">
    <span data-feather="plus-circle" class="align-text-bottom"></span>
  </a>
</h6>
<ul class="nav flex-column mb-2">
  <li class="nav-item">
    <a class="nav-link" href="#">
      <span data-feather="file-text" class="align-text-bottom"></span>
      Current month
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">
      <span data-feather="file-text" class="align-text-bottom"></span>
      Last quarter
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">
      <span data-feather="file-text" class="align-text-bottom"></span>
      Social engagement
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">
      <span data-feather="file-text" class="align-text-bottom"></span>
      Year-end sale
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#settings">
  <span data-feather="settings" class="align-text-bottom"></span>
  Pengaturan
</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-danger" href="logout_bootstrap.php">
  <span data-feather="log-out" class="align-text-bottom"></span>
  Sign out
</a>
  </li>
</ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <!-- Grafik area -->
      <h4>Sales Chart</h4>
      <div class="chart-container my-4">
        <canvas id="myChart"></canvas>
      </div>

      <!-- Konten lainnya -->
      <h2>Section title</h2>
      <hr>
<a id="settings"></a>
<h2>Pengaturan</h2>

<?php if (isset($update_message)): ?>
  <div class="alert alert-success"><?= $update_message ?></div>
<?php endif; ?>

<form method="POST">
  <input type="hidden" name="update_credentials" value="1">
  <div class="mb-3">
    <label for="new_username" class="form-label">Username Baru</label>
    <input type="text" class="form-control" id="new_username" name="new_username" required value="<?= $_SESSION['username'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label for="new_password" class="form-label">Password Baru</label>
    <input type="password" class="form-control" id="new_password" name="new_password" required>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 1; $i <= 10; $i++): ?>
              <tr>
                <td><?= $i ?></td>
                <td>Sample</td>
                <td>Data</td>
                <td>Goes</td>
                <td>Here</td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="dashboard.js"></script>

  </body>
</html>
