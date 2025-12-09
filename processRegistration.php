<?php

session_start();
require_once "includes/connectionString.php";

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: register.php");
        exit();
    }

    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';

    if ($email === '' || $password === '') {
        header("Location: index.php?action=register&status=error");
        exit();
    }
    //hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php?action=login&status=success");
        exit();
    } else {
        header("location: index.php?action=register&status=error");
        exit();
    }
?>