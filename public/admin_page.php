<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Page</title>
        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Emergency Waitlist</h1>
                <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Admin Page</h2>
            <div>
                <p>Welcome, <?=$_SESSION['name']?>!</p>
                <p>
                    <?php
                    date_default_timezone_set('Canada/Eastern');
                    $current_time = date('Y-m-d H:i:s', time());
                    echo "Current time: {$current_time}";
                    ?>
                </p>
                <?php
                // Import connection info
                require 'global.php';
                // Try and connect using the info above.
                $mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
                // Select patients from user table
                $query = "SELECT * FROM user WHERE user_role = 'patient' ORDER BY arrival_time ASC, severity DESC";
                // Execute above query
                $result = mysqli_query($mysqli, $query);
                // Convert $result to array
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                echo "<p>The list of patients is below:</p>";
                echo "
                <table>
                    <tr>
                        <th>Position</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Arrival Time</th>
                        <th>Severity</th>
                        <th>Appointment Time</th>
                    </tr>";

                // Patient's position in queue
                $position = 1;
                
                foreach ($rows as $row) {
                    // Desired time is arrival time
                    $appt_time = new DateTime($row["arrival_time"]);
                    // Check if time is taken
                    while (isset($appts[$appt_time->format('Y-m-d H:i:s')])) {
                        // Increment by 1 hour if taken
                        $appt_time->add(new DateInterval('PT1H'));
                    }

                    $query = "INSERT INTO appt (user_id, appt_time) VALUES ({$row['user_id']}, TIMESTAMP'{$appt_time->format('Y-m-d H:i:s')}')";
                    mysqli_execute_query($mysqli, $query);

                    // Skip if appointment time is past
                    if ((new DateTime($current_time)) >= $appt_time) {
                        continue;
                    }

                    echo "
                    <tr>
                        <td>{$position}</td>
                        <td>{$row["user_id"]}</td>
                        <td>{$row["username"]}</td>
                        <td>{$row["email"]}</td>
                        <td>{$row["arrival_time"]}</td>
                        <td>{$row["severity"]}</td>
                        <td>{$appt_time->format('Y-m-d H:i:s')}</td>
                    </tr>";

                    $position++;
                }

                echo "</table>";
                ?>
            </div>
        </div>
    </body>
</html>