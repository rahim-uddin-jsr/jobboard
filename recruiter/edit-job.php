<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location: " . BASE_URL . "login.php");
  exit;
}

$recruiter_id = $_SESSION['user_id'];
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch job data
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ? AND recruiter_id = ?");
$stmt->bind_param("ii", $job_id, $recruiter_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo '<div class="alert alert-danger">Job not found or access denied.</div>';
  exit;
}

$job = $result->fetch_assoc();

$page_title = "Edit Job";
$page_heading = "Update Job Listing";
include '../layout/layout_recruiter.php';
?>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title       = trim($_POST['title']);
  $company     = trim($_POST['company']);
  $location    = trim($_POST['location']);
  $salary      = trim($_POST['salary']);
  $description = trim($_POST['description']);

  $update = $conn->prepare("UPDATE jobs SET title = ?, company = ?, location = ?, salary = ?, description = ? WHERE id = ? AND recruiter_id = ?");
  $update->bind_param("sssssii", $title, $company, $location, $salary, $description, $job_id, $recruiter_id);

  if ($update->execute()) {
    echo '<div class="alert alert-success">Job updated successfully!</div>';
    // Optional: redirect to my-jobs.php
    // header("Location: " . BASE_URL . "recruiter/my-jobs.php");
    // exit;
  } else {
    echo '<div class="alert alert-danger">Failed to update job.</div>';
  }
}
?>

<form method="POST" action="">
  <div class="mb-3">
    <label class="form-label">Job Title</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($job['title']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Company Name</label>
    <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($job['company']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($job['location']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Salary Range</label>
    <input type="text" name="salary" class="form-control" value="<?= htmlspecialchars($job['salary']) ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Job Description</label>
    <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($job['description']) ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Job</button>
  <a href="recruiter/my-jobs.php" class="btn btn-secondary">Back to My Jobs</a>
</form>

<?php include '../layout/footer.php'; ?>