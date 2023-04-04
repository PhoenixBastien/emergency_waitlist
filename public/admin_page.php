<?php
// Start session
session_start();
// If the user is not logged in redirect to the login page
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
                    // Display current time
                    date_default_timezone_set('Canada/Eastern');
                    $current_time = date('Y-m-d H:i:s', time());
                    echo "Current time: {$current_time}";
                    ?>
                </p>
                <p>The list of patients is below:</p>
                <table>
                    <tr>
                        <th>Position</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Arrival Time</th>
                        <th>Severity</th>
                        <th>Appointment Time</th>
                    </tr>
                    <?php
                    // Import connection info
                    require 'global.php';
                    // Try and connect
                    $mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
                    // Select patients from user table
                    $query = "SELECT * FROM user WHERE user_role = 'patient' ORDER BY arrival_time ASC, severity DESC";
                    // Execute above query
                    $result = mysqli_query($mysqli, $query);
                    // Convert $result to array
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    // Patient's position in queue
                    $position = 1;
                    // Iterate user row
                    foreach ($rows as $row) {
                        // Desired time is arrival time
                        $appt_time = new DateTime($row["arrival_time"]);
                        // Check if time is taken
                        $query = "SELECT user_id FROM appt WHERE appt_time = '{$appt_time->format('Y-m-d H:i:s')}'";
                        while (mysqli_query($mysqli, $query)->num_rows === 0) {
                            // Increment by 1 hour if taken
                            $appt_time->add(new DateInterval('PT1H'));
                        }
                        // Add appointment to appt table
                        $query = "INSERT INTO appt (user_id, appt_time) VALUES ({$row['user_id']}, TIMESTAMP'{$appt_time->format('Y-m-d H:i:s')}')";
                        mysqli_execute_query($mysqli, $query);
                        // Skip if appointment time is past
                        if ((new DateTime($current_time)) >= $appt_time) {
                            continue;
                        }
                        // Display patient and appointment info
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
                        // Increment position in queue
                        $position++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>