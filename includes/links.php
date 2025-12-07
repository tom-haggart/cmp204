<?php
    $current_page = basename($_SERVER['PHP_SELF']);

    function isActive($page, $current_page) {
        return ($page === $current_page) ? 'class="nav-link active" aria-current="page"' : 'class="nav-link"';
    }
?>

<ul class="nav nav-pills">
    <li class="nav-item">
        <a href="index.php" <?php echo isActive("index.php", $current_page) ?>>Dashboard</a>
    </a>
    </li>
    <li class="nav-item"><a href="history.php" <?php echo isActive("history.php", $current_page) ?>>History</a></li>
    <li class="nav-item"><a href="teamMembers.php" <?php echo isActive("teamMembers.php", $current_page) ?>>Team Members</a></li>

    <!--only show if user is not signed in-->
    <li class="nav-item"><a href="register.php" <?php echo isActive("register.php", $current_page) ?>>Register</a></li>
    <li class="nav-item"><a href="login.php" <?php echo isActive("login.php", $current_page) ?>>Login</a></li>

    <!--only show if authenticated user is signed in-->
    <li class="nav-item"><a href="userProfile.php" <?php echo isActive("userProfile.php", $current_page) ?>>User Profile</a></li>
    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
</ul>