<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $page_title ?? 'Recruiter Dashboard' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="<?= BASE_URL ?>">
  <!-- Core Styles -->
  <link rel="stylesheet" href="assets/common/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/recruiter/css/recruiter.css">

  <!-- Core Scripts -->
  <script src="assets/common/js/jquery-3.7.1.js"></script>
  <script src="assets/common/js/bootstrap.bundle.min.js"></script>
  <script src="assets/recruiter/js/recruiter.js"></script>
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="recruiter/dashboard.php">Recruiter Panel</a>
      <div class="d-flex">
        <a href="logout.php" class="btn btn-outline-dark">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <?php if (isset($page_heading)): ?>
      <h2 class="mb-4"><?= $page_heading ?></h2>
    <?php endif; ?>
