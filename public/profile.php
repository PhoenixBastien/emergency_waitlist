<?php
// Import connection info
require 'db_config.php';
// Start session
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// Connect to database
$mysqli = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Get user's password and email from database
$stmt = $mysqli->prepare('SELECT user_password, email, user_role FROM user WHERE user_id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $role);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Profile Page</title>
        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Emergency Waitlist</h1>
                <?php
                if ($role === 'admin') {
                    echo '<a href="add_patient.php"><i class="fas fa-person-circle-plus"></i>Add Patient    </a>'; 
                }
                ?>
                <a href="<?=$role?>_page.php"><i class="fas fa-home"></i>Home</a>
                <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Profile Page</h2>
            <div>
                <p>Your account details are below:</p>
                <ul>
                    <li><strong>Username:</strong> <?=$_SESSION['name']?></li>
                    <li><strong>Password:</strong> <?=$password?></li>
                    <li><strong>Email:</strong> <?=$email?></li>
                    <li><strong>Role:</strong> <?=$role?></li>
                </ul>
            </div>
        </div>
    </body>
</html>