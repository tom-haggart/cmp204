<?php
    include_once "includes/session.php";
    include_once "includes/connectionString.php";
    include_once "includes/events.php";

    $userId = $_SESSION["user_id"];

    if (isset($_POST['action']) && $_POST['action'] == 'attend' && isset($_POST['user_id']) && isset($_POST['event_id'])) {
        $eventId = (int)$_POST['event_id'];

        if (attendEvent($conn, $userId, $eventId)) {
            header("Location: agenda.php?status=attending");
            echo "<p style='color:green;'>You're signed up!</p>";
            exit;
        } else {
            echo "<p style='color:red;'>Error: Could not process request.</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "includes/head.php" ?>
    <title>Agenda - Save Point Summit</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once "includes/header.php" ?>
    </div>

    <div class="container flex-grow-1">
        <h1>Agenda</h1>

        <?php
            if (isset($_GET["status"]) && $_GET["status"] === "attending") {
                echo "<p class='text-success'>You're signed up, <a href='profile.php'>Click here to view your events</a></p>";
            }
        ?>

        <section class="">
        <?php
            $events = getEvents($conn);

            if (!empty($events)) {
                echo "<table class='table table-striped'>";
                $prev_day_num = '';
                foreach ($events as $event) {
                    if ($event["day_num"] !== $prev_day_num) {
                        echo "<tr><td colspan='4'>Day " . htmlspecialchars($event["day_num"]) . "</td></tr>";
                        echo "<tr><th>Event</th><th>Name</th><th>Description</th><th></th></tr>";
                    }
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($event["type"]) . "</td>";
                    echo "<td>" . htmlspecialchars($event["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($event["description"]) . "</td>";
                    if (isUserAttendingEvent($conn, $userId, $event["id"])) {
                        echo "<td width='105'>You're Attending</td>";
                    } else {
                        echo "<td width='105'><form action='' method='POST'>
                        <input type='hidden' name='action' value='attend'>
                        <input type='hidden' name='event_id' value='" . htmlspecialchars($event["id"]) . "'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($userId) . "'>
                        <button type='submit'>Attend</button>
                        </form></td>";
                    }
                    echo "</tr>";
                    $prev_day_num = $event["day_num"];
                }
                echo "</table>";
            } else {
                echo "<p>What, you don't have any events yet!  <a href='agenda.php'>Click here to sign-up!</a></p>";
            }
        ?>
        </section>
    </div>

    <div class="container mt-auto">
        <?php include_once "includes/footer.php" ?>
    </div>
    <?php include_once "includes/scripts.php" ?>
</body>
</html>