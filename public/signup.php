<?php
// Import connection info
require 'db_config.php';
// Start session
session_start();
// Connect to database
$mysqli = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
if (mysqli_connect_errno()) {
    // Display the error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body class="signup">
        <nav class="navtop">
            <div>
                <h1>Emergency Waitlist</h1>
            </div>
        </nav>
        <div class="content">
            <h2>Sign Up</h2>
            <div>
            <form action="" method="post">
                <label for="username"><strong>Username:</strong></label>
                <input type="text" name="username" required>
                <label for="password"><strong>Password:</strong></label>
                <input type="password" name="password" required>
                <label for="email"><strong>Email address:</strong></label>
                <input type="email" name="email" required>
                <label for="arrival"><strong>Arrival time:</strong></label>
                <input type="datetime-local" name="arrival" required>
                <label for="severity"><strong>Injury severity:</strong></label>
                <input type="number" name="severity" min="1" max="5" required>
                <input type="submit" value="Submit">
            </form>
            <?php
            if (empty($_POST)){
                exit;
            }
            // Try to add patient
            try {
                $query = "INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) 
                VALUES (DEFAULT, '{$_POST['username']}', '{$_POST['password']}', '{$_POST['email']}', 'patient', 
                TIMESTAMP'{$_POST['arrival']}', '{$_POST['severity']}')";
                mysqli_query($mysqli, $query);
                header("Location: index.html");
            } catch (mysqli_sql_exception) {
                // Error number 1062 means duplicate key
                if (mysqli_errno($mysqli) === 1062) {
                    echo "<script>alert('Duplicate credentials entered.')</script>";
                }
            }
            ?>
        </div>
        </div>
    </body>
</html>