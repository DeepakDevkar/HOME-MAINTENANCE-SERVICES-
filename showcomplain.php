<?php
session_start();
if (!isset($_SESSION['worker_name'])) {
    header("Location: index.php");
    exit();
}

$workerName = $_SESSION['worker_name'];

$conn = new mysqli("localhost", "root", "", "project_pbl");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch matching records from reg table where first_name = workerName
$sql = "SELECT * FROM booked WHERE first_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $workerName);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9fc;
            font-family: 'Arial', sans-serif;
            padding: 30px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .card img {
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Orders Assigned to You (<?= htmlspecialchars($workerName) ?>)</h2>
    <div class="row g-4">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card p-3">
                       
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['first_name'] ) ?></h5>
                            <p class="card-text"><strong>Worker id:</strong> <?= htmlspecialchars($row['worker_id']) ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($row['worker_email']) ?></p>
                            <p class="card-text"><strong>City:</strong> <?= htmlspecialchars($row['location']) ?></p>
                            <p class="card-text"><strong>Booked At :</strong> <?= htmlspecialchars($row['booked_at']) ?></p>
                        
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No records found matching your name.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>