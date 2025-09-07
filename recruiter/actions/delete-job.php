<?php
session_start();
require_once '../../includes/config.php';
require_once '../../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location:" . BASE_URL . "login.php");
  exit;
}

$recruiter_id = $_SESSION['user_id'];
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
  
// Get previous page fallback
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URL . "recruiter/my-jobs.php";

// Verify job ownership
$stmt = $conn->prepare("SELECT id FROM jobs WHERE id = ? AND recruiter_id = ?");
$stmt->bind_param("ii", $job_id, $recruiter_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  header("Location: " . $redirect_url . "?error=unauthorized");
  exit;
}

// Proceed with deletion
$delete = $conn->prepare("DELETE FROM jobs WHERE id = ? AND recruiter_id = ?");
$delete->bind_param("ii", $job_id, $recruiter_id);

if ($delete->execute()) {
  header("Location: " . $redirect_url . "?success=deleted");
} else {
  header("Location: " . $redirect_url . "?error=failed");
}
exit;
?>
