<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $page_title ?? 'Admin Dashboard' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="<?= BASE_URL ?>">
  <!-- Core Styles -->
  <link rel="stylesheet" href="assets/common/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/admin/css/admin.css">

  <!-- Core Scripts -->
  <script src="assets/common/js/jquery-3.7.1.js"></script>
  <script src="assets/common/js/bootstrap.bundle.min.js"></script>
  <script src="assets/admin/js/admin.js"></script>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin/dashboard.php">Admin Panel</a>
      <div class="d-flex">
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <?php if (isset($page_heading)): ?>
      <h2 class="mb-4"><?= $page_heading ?></h2>
    <?php endif; ?>
