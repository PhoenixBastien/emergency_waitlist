<?php
session_start();
// Change this to your connection info.
$host = 'localhost';
$username = 'root';
$password = 'password';
$dbname = 'emergency_waitlist';
$port = '3306';
// Try and connect using the info above.
$mysqli = mysqli_connect($host, $username, $password, $dbname, $port);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $mysqli->prepare('SELECT user_id, user_password, user_role FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $role);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($_POST['password'] === $password && $_POST['role'] === $role) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;
            header("Location: {$role}_page.php");
        } else {
            // Incorrect password
            echo 'Incorrect username, password or role!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username, password or role!';
    }

	$stmt->close();
}
?>