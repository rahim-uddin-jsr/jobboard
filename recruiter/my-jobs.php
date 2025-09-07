<?php
session_start();

require_once '../includes/config.php';
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location: " . BASE_URL . "login.php");
  exit;
}

$page_title = "My Posted Jobs";
$page_heading = "Manage Your Listings";
include '../layout/layout_recruiter.php';

// Fetch jobs posted by this recruiter
$recruiter_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, title, company, location, salary, created_at FROM jobs WHERE recruiter_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $recruiter_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php if ($result->num_rows > 0): ?>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Title</th>
        <th>Company</th>
        <th>Location</th>
        <th>Salary</th>
        <th>Posted</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($job = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($job['title']) ?></td>
          <td><?= htmlspecialchars($job['company']) ?></td>
          <td><?= htmlspecialchars($job['location']) ?></td>
          <td><?= htmlspecialchars($job['salary']) ?></td>
          <td><?= date('d M Y', strtotime($job['created_at'])) ?></td>
          <td>
            <a href="recruiter/edit-job.php?id=<?= $job['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="recruiter/actions/delete-job.php?id=<?= $job['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">You haven’t posted any jobs yet.</div>
<?php endif; ?>

<?php include '../layout/footer.php'; ?>
