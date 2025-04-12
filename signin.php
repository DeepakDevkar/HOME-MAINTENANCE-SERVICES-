<?php
session_start();
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = "";     // Default XAMPP password is blank
$dbname = "project_pbl"; // Your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Protect against SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Check if user exists
    $query = "SELECT * FROM userss WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Login success
            $_SESSION['worker_name'] = $row['username'];
            $_SESSION['worker_email'] = $row['email'];
            echo "success";
        } else {
            echo "invalid"; // wrong password
        }
    } else {
        echo "invalid"; // user not found
    }
}
?>