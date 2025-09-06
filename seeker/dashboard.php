<?php
require_once '../includes/auth_seeker.php';
$page_title = "Job Seeker Dashboard";
$page_heading = "Welcome, Job Seeker";
include '../layout/layout_seeker.php';
?>

<!-- Seeker-specific content -->
<div class="row">
  <div class="col-md-6">
    <a href="browse-jobs.php" class="btn btn-success mb-3">Browse Jobs</a>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Saved Applications</h5>
        <p class="card-text">You have 3 pending applications.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
