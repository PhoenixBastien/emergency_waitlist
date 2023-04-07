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
// Check if the data exists
if (!isset($_POST['username'], $_POST['password'], $_POST['role'])) {
    // Could not get the data that should have been sent
    exit('Please fill all fields!');
}
// Prepare our SQL
if ($stmt = $mysqli->prepare('SELECT user_id, user_password, user_role FROM user WHERE username = ?')) {
    // Bind parameters
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result
    $stmt->store_result();
    // Check if user exists in the database
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $role);
        $stmt->fetch();
        // Check if password and role are correct
        if ($_POST['password'] === $password && $_POST['role'] === $role) {
            // Create session
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;
            // Redirect to page based on role
            header("Location: {$role}_page.php");
        } else {
            // Incorrect credentials
            exit('Incorrect credentials!');
        }
    } else {
        // Incorrect credentials
        exit('Incorrect credentials!');
    }
    $stmt->close();
}
?>