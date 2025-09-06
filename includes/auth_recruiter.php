<?php
session_start();
require_once 'config.php'; // Ensure BASE_URL is defined

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
  header("Location: " . BASE_URL . "login.php");
  exit;
}
?>
