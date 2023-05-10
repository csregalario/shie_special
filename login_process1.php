<?php
// Include the database connection code
include_once 'connection.php';

// Start the session
session_start();

// Retrieve the form data
$email_add = mysqli_real_escape_string($conn, $_POST['email_add']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Validate the input
if (empty($email_add) || empty($password)) {
    // Handle the error - email add and password are required
    $_SESSION['login_error'] = 'email and password are required';
    header('Location: home2.php');
    exit();
}

// Check the credentials against the database
$sql = "SELECT * FROM user WHERE email_add = '$email_add' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // The login credentials are valid - set the session variable and redirect the user to the home page
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['user_id'];
    header('Location: home2.php');
    exit();
} else {
    // The login credentials are invalid - display an error message and prompt the user to try again
    $_SESSION['login_error'] = 'Invalid email add or password';
    header('Location: home1.php?error=login');
    exit();
}
?>
