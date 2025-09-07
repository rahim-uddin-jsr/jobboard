<?php
session_start();
require_once '../includes/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location: " . BASE_URL . "login.php");
  exit;
}

$page_title = "Post a New Job";
$page_heading = "Create Job Listing";
include '../layout/layout_recruiter.php';
?>

<form method="POST" action="recruiter/actions/post_job.php" class="mb-5">
  <div class="mb-3">
    <label class="form-label">Job Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Company Name</label>
    <input type="text" name="company" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Salary Range</label>
    <input type="text" name="salary" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Job Description</label>
    <textarea name="description" class="form-control" rows="5" required></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Post Job</button>
</form>

<?php include '../layout/footer.php'; ?>
