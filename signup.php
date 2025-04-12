<?php
$conn = new mysqli("localhost", "root", "", "project_pbl");

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if username or email exists
$check = $conn->prepare("SELECT id FROM userss WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "Username or Email already exists";
} else {
    $stmt = $conn->prepare("INSERT INTO userss (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error";
    }
}
?>