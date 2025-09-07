<?php
require_once '../includes/auth_recruiter.php';
$page_title = "Recruiter Dashboard";
$page_heading = "Welcome, Recruiter";
include '../layout/layout_recruiter.php';
?>

<!-- Recruiter-specific content -->
<div class="row">
  <div class="col-md-6">
    <a href="recruiter/post-job.php" class="btn btn-primary mb-3">Post New Job</a>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Active Jobs</h5>
        <p class="card-text">You have 12 active job listings.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
