<?php
require_once '../includes/auth_admin.php';
$page_title = "Admin Dashboard";
$page_heading = "Welcome, Admin";
include '../layout/layout_admin.php';
?>

<!-- Admin-specific content -->
<div class="row">
  <div class="col-md-4">
    <div class="card text-bg-primary mb-3">
      <div class="card-body">
        <h5 class="card-title">Total Users</h5>
        <p class="card-text">123</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-bg-success mb-3">
      <div class="card-body">
        <h5 class="card-title">Active Jobs</h5>
        <p class="card-text">45</p>
      </div>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
