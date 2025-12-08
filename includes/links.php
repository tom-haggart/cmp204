<?php
    $current_page = basename($_SERVER["PHP_SELF"]);
    $is_logged_in = isset($_SESSION['username']);

    function isActive($page, $current_page) {
        return ($page === $current_page) ? 'class="nav-link active" aria-current="page"' : 'class="nav-link"';
    }
?>

<ul class="nav nav-pills">
    <?php if (!$is_logged_in): ?>
        <li class="nav-item">
            <a href="index.php" <?php echo isActive("index.php", $current_page) ?>>Home</a>
        </a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a href="dashboard.php" <?php echo isActive("dashboard.php", $current_page) ?>>Dashboard</a>
        </a>
        </li>
    <?php endif; ?>
    <li class="nav-item"><a href="history.php" <?php echo isActive("history.php", $current_page) ?>>History</a></li>
    <li class="nav-item"><a href="teamMembers.php" <?php echo isActive("teamMembers.php", $current_page) ?>>Team Members</a></li>

    <?php if ($is_logged_in): ?>
    <!--only show if authenticated user is signed in-->
    <li class="nav-item"><a href="userProfile.php" <?php echo isActive("userProfile.php", $current_page) ?>>User Profile</a></li>
    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
    <?php endif; ?>
</ul>