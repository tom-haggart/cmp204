<?php
function getUser($conn, $userId) {
    if (!$userId) {
        return [];
    }

    $sql = "SELECT id, email FROM users WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    return $user;
}
?>