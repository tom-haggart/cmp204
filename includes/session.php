<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  $public_pages = ['index.php', 'login.php', 'register.php', 'req.php', 'userProfile.php'];
  $current_page = basename($_SERVER["PHP_SELF"]);


  if (!isset($_SESSION['email'])) {
    if (!in_array($current_page, $public_pages)) {
      header("Location: index.php");
      exit();
    } else if (isset($_SESSION['email']) && $current_page === "index.php") {
      header("Location: dashboard.php");
      exit();
    }
  }
?>