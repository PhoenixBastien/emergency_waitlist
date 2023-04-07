<?php
// Import connection info
require 'db_config.php';
// Start session
session_start();
// If the user is not logged in redirect to the login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
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
        <title>Add Patient</title>
        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Emergency Waitlist</h1>
                <a href="add_patient.php"><i class="fas fa-person-circle-plus"></i>Add Patient</a>
                <a href="<?=$_SESSION['role']?>_page.php"><i class="fas fa-home"></i>Home</a>
                <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Add Patient</h2>
            <div>
                <form action="" method="post">
                    <label for="username"><strong>Patient's username:</strong></label>
                    <input type="text" name="username" id="username" required>
                    <label for="password"><strong>Patient's password:</strong></label>
                    <input type="password" name="password" id="password" required>
                    <label for="email"><strong>Patient's email address:</strong></label>
                    <input type="email" name="email" id="email" required>
                    <label for="arrival"><strong>Patient's arrival time:</strong></label>
                    <input type="datetime-local" name="arrival" id="arrival" required>
                    <label for="severity"><strong>Patient's injury serverity:</strong></label>
                    <input type="number" name="severity" name="severity" id="severity" min="1" max="5" required>
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
                    header("Location: {$_SESSION['role']}_page.php");
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

