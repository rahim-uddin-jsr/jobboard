<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location: ../login.php");
  exit;
}
?>
