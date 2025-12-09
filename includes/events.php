<?php
function getEvents($conn) {
    $sql = "SELECT e.id, e.name, e.description, e.day_num, e.type
            FROM events e
            ORDER BY e.day_num ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    $stmt->close();

    return $events;
}

function getUserEvents($conn, $userId) {
    if (!$userId) {
        return [];
    }

    $sql = "SELECT e.id, e.name, e.description, e.day_num, e.type
            FROM events e
            JOIN event_attendees ea ON e.id = ea.event_id
            WHERE ea.user_id = ?
            ORDER BY e.day_num ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    $stmt->close();

    return $events;
}

function attendEvent($conn, $userId, $eventId) {
    if (!$userId || !$eventId) {
        return false;
    }

    $sql = "INSERT INTO event_attendees (user_id, event_id) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $eventId);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}

function unattendEvent($conn, $userId, $eventId) {
    if (!$userId || !$eventId) {
        return false;
    }

    $sql = "DELETE FROM event_attendees WHERE user_id = ? AND event_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $eventId);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}

function isUserAttendingEvent($conn, $userId, $eventId) {
    if (!$userId || !$eventId) {
        return false;
    }

    $sql = "SELECT 1 FROM event_attendees WHERE user_id = ? AND event_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $eventId);
    $execute_success = $stmt->execute();

    $result = $stmt->get_result();
    $is_attending = ($result->num_rows > 0);

    $result->free();
    $stmt->close();

    return $is_attending;
}
?>