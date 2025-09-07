<?php
session_start();
require_once '../../includes/db.php';

if (isset($_POST['submit'])) {
  $title = trim($_POST['title']);
  $company = trim($_POST['company']);
  $location = trim($_POST['location']);
  $salary = trim($_POST['salary']);
  $description = trim($_POST['description']);
  $recruiter_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("INSERT INTO jobs (title, company, location, salary, description, recruiter_id) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssi", $title, $company, $location, $salary, $description, $recruiter_id);

  if ($stmt->execute()) {
    echo '<div class="alert alert-success">Job posted successfully!</div>';
  } else {
    echo '<div class="alert alert-danger">Failed to post job. Try again.</div>';
  }
}

