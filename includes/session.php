<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$public_pages = ['index.php', 'login.php', 'register.php', 'req.php', 'history.php', 'teamMembers.php'];
$current_page = basename($_SERVER["PHP_SELF"]);

$is_logged_in = isset($_SESSION['email']) && isset($_SESSION['user_id']);

if (!$is_logged_in) {
    if (!in_array($current_page, $public_pages)) {
        header("Location: index.php");
        exit();
    }

} else {
    if ($current_page === "index.php" || $current_page === "login.php") {
        header("Location: dashboard.php");
        exit();
    }
}
?>