<?php
// Import connection info
require 'db_config.php';
// Import database functions
require 'db_functions.php';
// Start session
session_start();
// If the user is not logged in redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.html');
    exit;
}
// Connect to database
$mysqli = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
if (mysqli_connect_errno()) {
    // Display the error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Set timezone
date_default_timezone_set('Canada/Eastern');
// Get current time
$current_time = new DateTime();
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
                <a href="add_patient.php"><i class="fas fa-person-circle-plus"></i>Add Patient</a>
                <a href="admin_page.php"><i class="fas fa-home"></i>Home</a>
                <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Admin Page</h2>
            <div>
                <p>Welcome, <?=$_SESSION['name']?>!</p>
                <p>Current time: <?=$current_time->format('Y-m-d H:i:s')?></p>
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
                    // Sort appointments
                    sort_appts($mysqli);
                    // Array of patients
                    $patients = get_patients($mysqli);
                    // Patient's position in queue
                    $position = 1;
                    // Iterate user row
                    foreach ($patients as $patient) {
                        $appt_time = new DateTime($patient['appt_time']);
                        // Skip if appointment time is past
                        if ($current_time >= $appt_time) {
                            continue;
                        }
                        // Display patient and appointment info
                        echo "
                        <tr>
                            <td>{$position}</td>
                            <td>{$patient['user_id']}</td>
                            <td>{$patient['username']}</td>
                            <td>{$patient['email']}</td>
                            <td>{$patient['arrival_time']}</td>
                            <td>{$patient['severity']}</td>
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