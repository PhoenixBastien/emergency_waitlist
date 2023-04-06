<?php
// Import connection info
require 'global.php';
// Import database functions
require 'db_functions.php';
// Start session
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// Connect to database
$mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
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
        <title>Patient Page</title>
        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Emergency Waitlist</h1>
                <a href="patient_page.php"><i class="fas fa-home"></i>Home</a>
                <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Patient Page</h2>
            <div>
                <p>Welcome, <?=$_SESSION['name']?>!</p>
                <p>Current time: <?=$current_time->format('Y-m-d H:i:s')?></p>
                <?php
                // Sort appointments
                sort_appts($mysqli);
                // Get appointment of current user
                $appt_time = get_appt_time($mysqli, $_SESSION['id']);
                // Display patient's appointment info
                if ($current_time >= $appt_time) {
                    echo "<p>No upcoming appointment</p>";
                } else {
                    $wait_time = $current_time->diff($appt_time);
                    echo "<p>Your appointment time: {$appt_time->format('Y-m-d H:i:s')}</p>";
                    echo "<p>Your approximate wait time: 
                            {$wait_time->days} day(s) 
                            {$wait_time->h} hour(s) 
                            {$wait_time->i} minute(s)</p>";
                }
                ?>
            </div>
        </div>
    </body>
</html>