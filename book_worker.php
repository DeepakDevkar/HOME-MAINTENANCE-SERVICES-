<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "project_pbl";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['worker_username'])) {
    $worker_username = $conn->real_escape_string($_POST['worker_username']);

    // Generate a unique complaint ID (or use auto-increment if already present)
    $complaint_id = uniqid("CMP-");
    $user_username = 'normaluser123'; // Replace with session or actual logged-in user

    // Insert into complaints_tb
    $insertComplaint = "INSERT INTO complaints_tb (complaint_id, user_username, worker_username, status, complaint_date)
                        VALUES ('$complaint_id', '$user_username', '$worker_username', 'Pending', NOW())";
    $conn->query($insertComplaint);

    // Set initial tracking status
    $insertTracking = "INSERT INTO tracking_status (worker_id, status, updated_at)
                       VALUES ('$worker_username', 'Assigned', NOW())
                       ON DUPLICATE KEY UPDATE status='Assigned', updated_at=NOW()";
    $conn->query($insertTracking);

    echo "Booking confirmed and status set to Assigned.";
} else {
    echo "Invalid request.";
}

$conn->close();
?>