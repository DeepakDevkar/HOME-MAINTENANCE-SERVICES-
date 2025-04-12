<?php
session_start();
if (!isset($_SESSION['worker_name'])) {
    header("Location: index.php");
    exit();
}

$workerName = $_SESSION['worker_name'];
$worker_username = $_SESSION['worker_name']; // assuming worker_name is same as username
$worker_id = 'WKR-1023'; // You can dynamically fetch this from DB if needed

$conn = new mysqli("localhost", "root", "", "project_pbl");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count bookings for this worker
$sql = "SELECT COUNT(*) as total FROM complaints_tb WHERE worker_username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $worker_username);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$total = $data['total'] ?? 0;

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $status = $_POST['status'];

    $check = $conn->query("SELECT * FROM tracking_status WHERE worker_id='$worker_id'");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE tracking_status SET status='$status' WHERE worker_id='$worker_id'");
    } else {
        $conn->query("INSERT INTO tracking_status (worker_id, status) VALUES ('$worker_id', '$status')");
    }

    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
    exit;
}

// Fetch current status
$currentStatus = 'Not Set';
$result = $conn->query("SELECT status FROM tracking_status WHERE worker_id='$worker_id'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentStatus = $row['status'];
}

// Fetch complaint data like showcomplain.php
$complaintQuery = "SELECT * FROM booked WHERE first_name = ?";
$compStmt = $conn->prepare($complaintQuery);
$compStmt->bind_param("s", $workerName);
$compStmt->execute();
$complaints = $compStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Worker Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
    font-family: 'Roboto', sans-serif;
    background: url('https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg') no-repeat center center / cover;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    color: #000;
}

.header-area {
    background: rgba(255, 255, 255, 0.2);
    padding: 20px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    border-radius: 0 0 20px 20px;
}

.main-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.main-nav .logo {
    font-size: 1.8rem;
    font-weight: 700;
    color: #000;
    text-decoration: none;
}

.main-nav .nav {
    list-style: none;
    display: flex;
    gap: 30px;
    margin: 0;
    padding: 0;
    align-items: center;
}

.main-nav .nav li a {
    text-decoration: none;
    color: #000;
    font-weight: 500;
    transition: color 0.3s ease;
}

.main-nav .nav li a:hover {
    color: #f09819;
}

.main-nav .gradient-button a {
    background: linear-gradient(to right, #ff5858, #f09819);
    padding: 8px 16px;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.main-nav .gradient-button a:hover {
    opacity: 0.9;
}

/* Worker Info Card */
.worker-card {
    position: fixed;
    top: 100px;
    left: 30px;
    width: 380px;
    max-width: 100%;
    height: 550px;
    padding: 25px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 25px;
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    overflow-y: auto;
}

.worker-card .worker-img {
    width: 140px;
    height: 140px;
    border-radius: 20%;
    object-fit: cover;
    margin-bottom: 30px;
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.worker-card .worker-name {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

/* Progress Cards */
.progress-cards {
    position: fixed;
    top: 100px;
    left: 850px;
    display: flex;
    flex-direction: column;
    gap: 30px;
    z-index: 999;
}

.progress-card {
    width: 350px;
    padding: 25px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.progress-card h5 {
    margin-bottom: 10px;
    font-weight: 600;
}

.progress-card button {
    padding: 6px 12px;
    background-color: #f09819;
    border: none;
    color: #fff;
    border-radius: 6px;
    margin-bottom: 10px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.3s ease;
}

.progress-card button:hover {
    background-color: #d87f13;
}

.progress-container {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    height: 8px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    width: 0%;
    background-color: #28a745;
    transition: width 1s ease-in-out;
}

/* Complaint Section */
.complaint-section {
    margin-left: 430px;
    margin-top: 720px;
    padding: 40px 20px;
}

    </style>
</head>
<body>
    <header class="header-area">
        <div class="container">
            <nav class="main-nav">
                <a href="w.php" class="logo"><?php echo htmlspecialchars($workerName); ?> (Worker)</a>
                <ul class="nav">
                    <li><a href="#top" class="active">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#newsletter">Newsletter</a></li>
                    <li>
                        <div class="gradient-button">
                            <a href="logout.php"><i class="fa fa-sign-out-alt"></i> log out </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="worker-card">
        <img src="https://i.ibb.co/0j1vgh4/profile-icon.png" alt="Worker Image" class="worker-img">
        <?php if ($complaints->num_rows > 0): ?>
                <?php while ($row = $complaints->fetch_assoc()): ?>
                  
                        
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['first_name']) ?></h5>
                                <p class="card-text"><strong>Worker ID:</strong> <?= htmlspecialchars($row['worker_id']) ?></p>
                                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($row['worker_email']) ?></p>
                                <p class="card-text"><strong>City:</strong> <?= htmlspecialchars($row['location']) ?></p>
                                <p class="card-text"><strong>Booked At:</strong> <?= htmlspecialchars($row['booked_at']) ?></p>
                            </div>
                        
                    
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-white">No complaints/orders found.</p>
            <?php endif; ?>
            
        <p>Current Status: <strong><?php echo $currentStatus; ?></strong></p>
    </div>

    <form method="POST">
        <div class="progress-cards">
            <div class="progress-card">
                <h5>Assigned</h5>
                <button name="status" value="Assigned">Tap</button>
                <div class="progress-container">
                    <div class="progress-bar" id="assignedProgress"></div>
                </div>
            </div>

            <div class="progress-card">
                <h5>On the Way</h5>
                <button name="status" value="On the Way">Tap</button>
                <div class="progress-container">
                    <div class="progress-bar" id="onTheWayProgress"></div>
                </div>
            </div>

            <div class="progress-card">
                <h5>Arrived</h5>
                <button name="status" value="Arrived">Tap</button>
                <div class="progress-container">
                    <div class="progress-bar" id="arrivedProgress"></div>
                </div>
            </div>
        </div>
    </form>

    <!-- Complaint Section -->
   

    <script>
        const stages = {
            "Assigned": "assignedProgress",
            "On the Way": "onTheWayProgress",
            "Arrived": "arrivedProgress"
        };
        const currentStatus = "<?php echo $currentStatus; ?>";
        window.onload = function () {
            if (stages[currentStatus]) {
                document.getElementById(stages[currentStatus]).style.width = '100%';
            }
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
