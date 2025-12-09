<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "includes/head.php" ?>
    <title>Profile - Save Point Summit</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once "includes/header.php" ?>
    </div>

    <div class="container flex-grow-1">
        <h1>Profile</h1>
        <?php
            include "includes/connectionString.php";

            $userId = 1;

            $sql = "SELECT e.name, e.description, e.event_date
                    FROM events e
                    JOIN events_attendees ea ON e.id = ea.event_id
                    WHERE ea.user_id = ?
                    ORDER BY e.event_date DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>My Events</h2>";

                echo "<table class='table table-striped'>";
                echo "<tr><th>Event</th><th>Description</th><th>Date</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["event_date"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No events found for this user.</p>";
            }

            $stmt->close();
        ?>
    </div>

    <div class="container mt-auto">
        <?php include_once "includes/footer.php" ?>
    </div>
    <?php include_once "includes/scripts.php" ?>
</body>
</html>