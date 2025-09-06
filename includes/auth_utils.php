<?php
require_once 'config.php'; // Make sure BASE_URL is available

function redirect_by_role($role) {
  switch ($role) {
    case 'admin':
      header("Location: " . BASE_URL . "admin/dashboard.php");
      break;
    case 'recruiter':
      header("Location: " . BASE_URL . "recruiter/dashboard.php");
      break;
    case 'seeker':
      header("Location: " . BASE_URL . "seeker/dashboard.php");
      break;
    default:
      header("Location: " . BASE_URL . "login.php");
  }
  exit;
}
