<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "project_pbl");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get worker_id from URL
$worker_id = $_GET['worker_id'] ?? null;

if ($worker_id) {
    // Prepare and execute query safely
    $stmt = $conn->prepare("SELECT * FROM reg WHERE id = ?");
    $stmt->bind_param("i", $worker_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If worker is found
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store all relevant values in session
        $_SESSION['worker_id'] = $row['id'];
        $_SESSION['worker_name'] = $row['first_name'] . " " . $row['last_name'];
        $_SESSION['worker_price'] = $row['price'];
        $_SESSION['worker_city'] = $row['city'];
        $_SESSION['worker_type'] = $row['worker_type'];
        $_SESSION['worker_email'] = $row['email']; // You can change to 'email' if that column exists
        $_SESSION['worker_image'] = $row['profile_image']; // ✅ Store profile image

        // Redirect to next page
        header("Location: order.php");
        exit;
    } else {
        echo "Worker not found.";
    }
} else {
    echo "No worker selected.";
}
?>