<?php
$conn = new mysqli("localhost", "root", "", "project_pbl");

$worker_id = 'WKR-1023';

$status = 'Assigned';
$result = $conn->query("SELECT status FROM tracking_status WHERE worker_id='$worker_id'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['status'];
}
echo $status;
?>