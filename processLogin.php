<?php
session_start();
require_once "includes/connectionString.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    
if ($email === '' || $password === '') {
    header("Location: index.php?action=login&error=no_details");
    exit();
}

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {

        $storedHash = $row["password"];
        $userId = $row["id"];

        if (password_verify($password, $storedHash)) {
            $_SESSION["user_id"] = $userId;
            $_SESSION["email"] = $email;
            header("Location: agenda.php");
            exit();
        } else {
            header("Location: index.php?action=login&error=wrongpass");
            exit();
        }
    }

    header("Location:  index.php?action=login&error=usernotfound");
    exit();
}
?>