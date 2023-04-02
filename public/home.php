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
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
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
			<h2>Home Page</h2>
            <div>
			<p>Welcome, <?=$_SESSION['name']?>!</p>
            <p>
                <?php
                date_default_timezone_set('Canada/Eastern');
                $time = date('h:i:s a', time());
                echo "Current time: " . $time;
                ?>
            </p>
                <?php
                // Change this to your connection info.
                $host = 'localhost';
                $username = 'root';
                $password = 'password';
                $dbname = 'phplogin';
                $port = '3306';
                // Try and connect using the info above.
                $mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
                // Select patients from user table
                $query = "SELECT * 
                          FROM user 
                          WHERE user_role = 'patient' 
                          AND arrival_time < CAST(current_time() AS TIME)
                          ORDER BY arrival_time ASC, severity DESC";
                // Execute above query
                $result = mysqli_query($mysqli, $query);
                // Convert $result to array
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                // Display table of patients for admin
                echo "<p>The list of patients is below:</p>
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Arrival Time</th>
                        <th>Severity</th>
                    </tr>";
                
                foreach ($rows as $row) {
                    echo "<tr>";
                    printf("<td>%s</td>", $row["user_id"]);
                    printf("<td>%s</td>", $row["username"]);
                    printf("<td>%s</td>", $row["user_password"]);
                    printf("<td>%s</td>", $row["email"]);
                    printf("<td>%s</td>", $row["arrival_time"]);
                    printf("<td>%s</td>", $row["severity"]);
                    echo "</tr>";
                }

                echo "</table>";
                ?>
            </div>
		</div>
	</body>
</html>