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
		<title>Patient Page</title>
		<link rel="stylesheet" href="assets/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Patient Page</h2>
            <div>
			<p>Welcome, <?=$_SESSION['name']?>!</p>
            <p>
                <?php
                date_default_timezone_set('Canada/Eastern');
                $current_time = date('Y-m-d H:i:s', time());
                echo "Current time: " . $current_time;
                ?>
            </p>
            <?php
            // Change this to your connection info.
            $host = 'localhost';
            $username = 'root';
            $password = 'password';
            $dbname = 'emergency_waitlist';
            $port = '3306';
            // Try and connect using the info above.
            $mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
            // Select patients from user table
            // AND arrival_time < CAST(current_time() AS TIME)
            $query = "SELECT * FROM user WHERE user_role = 'patient' ORDER BY arrival_time ASC, severity DESC";
            // Execute above query
            $result = mysqli_query($mysqli, $query);
            // Convert $result to array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // Array with appointments
            $appts = array();
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
                // Set patient's appointment time
                $appts[$appt_time->format('Y-m-d H:i:s')] = $row["username"];
                $row["appt_time"] = $appt_time->format('Y-m-d H:i:s');
                $row["position"] = $position++;
            }

            if ((new DateTime($current_time)) >= (new DateTime(array_search($_SESSION['name'], $appts)))) {
                echo "<p>No upcoming appointment</p>";
            } else {
                $wait_time = (new DateTime($current_time))->diff(new DateTime(array_search($_SESSION['name'], $appts)));
                echo "<p>Your appointment time: " . array_search($_SESSION['name'], $appts) . "</p>";
                echo "<p>Your approximate wait time: {$wait_time->days} day(s) {$wait_time->h} hour(s) {$wait_time->i} minute(s)</p>";
            }
            ?>
            </div>
		</div>
	</body>
</html>