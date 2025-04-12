<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require 'D:/xampp/htdocs/PPBL/PHPMailer-master/src/Exception.php';
require 'D:/xampp/htdocs/PPBL/PHPMailer-master/src/PHPMailer.php';
require 'D:/xampp/htdocs/PPBL/PHPMailer-master/src/SMTP.php';

// Database connection
$conn = new mysqli("localhost", "root", "", "project_pbl");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the booking data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $worker_id = $_POST['worker_id'] ?? '';
    $worker_name = $_POST['worker_name'] ?? '';
    $worker_email = $_POST['worker_email'] ?? '';
    $location = $_POST['location'] ?? '';

    if (empty($worker_email) || empty($worker_name) || empty($location) || empty($worker_id)) {
        echo "Missing required fields.";
        exit;
    }

    // Sanitize inputs for DB
    $safe_worker_id = $conn->real_escape_string($worker_id);
    $safe_worker_name = $conn->real_escape_string($worker_name);
    $safe_worker_email = $conn->real_escape_string($worker_email);
    $safe_location = $conn->real_escape_string($location);

    // Insert into `booked` table
    $sql = "INSERT INTO booked (worker_id, first_name, worker_email, location, booked_at)
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $safe_worker_id, $safe_worker_name, $safe_worker_email, $safe_location);

    if ($stmt->execute()) {
        // Continue to send the email only if DB insert was successful
        $mail = new PHPMailer(true);

        try {
            // Server settings for Gmail SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'xxxx@gmail.com '; // Your Gmail
            $mail->Password = 'xxxxxxxxxx';       // Your app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('xxx@gmail.com', 'DP Home Services');
            $mail->addAddress($worker_email, $worker_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Booking Request';
            $mail->Body = "
                <h2>Hello $worker_name,</h2>
                <p>You have received a new booking request from a customer.</p>
                <p><strong>Customer Location:</strong> $location</p>
                <p>Please respond as soon as possible.</p>
                <br>
                <p>Regards,<br><strong>DP Home Services</strong></p>
            ";

            // Send the email
            $mail->send();
            echo "Booking confirmed. Email sent to $worker_email.";
        } catch (Exception $e) {
            echo "Booking saved, but failed to send email. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error while booking: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>