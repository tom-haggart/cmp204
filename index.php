<?php
    include_once "includes/session.php";

    $action = isset($_GET['action']) && $_GET['action'] === 'register' ? 'register' : 'login';
    $active_classes   = 'btn text-white w-50 rounded-3 shadow-sm';
    $active_style     = 'style="background-color: #101922;"';

    $inactive_classes = 'btn text-secondary w-50 border-0';
    $inactive_style   = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "includes/head.php" ?>
    <title>Save Point Summit</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once "includes/header.php" ?>
    </div>

    <div class="container flex-grow-1">
      <div class="container d-flex justify-content-center align-items-center">
        <div class="row w-100 shadow-lg g-0 mt-4">
          <div class="col-lg-6 d-flex justify-content-center align-items-center p-5 bg-alt">
            <div class="rounded-3 text-white">
              <div class="d-flex justify-content-left align-items-center">
                <img src="img/logo.svg" class="me-3 img-fluid w-20 w-lg-auto" alt="Logo">
                <span class="fs-2">Save Point Summit</span>
              </div>
              <p class="fs-2 mt-3 mb-4 fw-semibold">Manage Your Summit Experience</p>
              <p class="fs-5">Log in to view your attendance history, event schedule, and connect with fellow gamers.</p>
            </div>
          </div>
          <div class="col-lg-6 p-5" style="background-color: #101922;">
            <div class="w-75 mx-auto">
              <div class="d-flex p-1 rounded-3 mb-4" style="background-color: #1B2733;">
            
            
              <button onclick="location.href='?action=login'"
              class="<?php echo ($action === 'login') ? $active_classes : $inactive_classes; ?>"
              <?php echo ($action === 'login') ? $active_style : $inactive_style; ?>
              type="button">
              Login

            <!-- Register Button -->
            <button onclick="location.href='?action=register'"
              class="<?php echo ($action === 'register') ? $active_classes : $inactive_classes; ?>"
              <?php echo ($action === 'register') ? $active_style : $inactive_style; ?>
              type="button">
              Register
            </button>
              </div>
                <?php
                  if (isset($_GET["action"]) && isset($_GET["status"])) {
                    $action = $_GET["action"];
                    $status = $_GET["status"];
                    
                    if ($action === 'register') {
                      if ($status === 'error') {
                        echo "<p class='text-danger'>Registration failed, please try again</p>";
                      }
                    }

                    if ($action === 'login') {
                      if ($status === 'error') {
                        echo "<p class='text-danger'>Login failed, please try again</p>";
                      }
                    
                      if ($status === 'success') {
                        echo "<p class='text-success'>Registered successfully, please login</p>";
                      }
                    }
                  }
                ?>
                <?php
                if ($action === 'register') {
                    include "register.php";
                } else {
                    include "login.php";
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-auto">
        <?php include_once "includes/footer.php" ?>
    </div>
    <?php include_once "includes/scripts.php" ?>
</body>
</html>