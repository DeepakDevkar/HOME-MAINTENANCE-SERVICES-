<?php
session_start();
if (!isset($_SESSION['worker_name'])) {
    header("Location: index.php");
    exit();
}

$workerName = $_SESSION['worker_name'];
$worker_username = $_SESSION['worker_name']; // assuming username and name are same

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Worker Dashboard</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">

    <!-- Bootstrap -->
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

        .gradient-button a {
            background: linear-gradient(to right, #ff5858, #f09819);
            padding: 8px 16px;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .gradient-button a:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .main-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .main-nav .nav {
                flex-direction: column;
                gap: 15px;
                margin-top: 10px;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease;
        }

        .glass-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body>



    <div id="mainContent">
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

        <section class="container my-5">
            <div class="row justify-content-center g-4">
                <!-- First Card -->
                <div class="col-md-6">
                    <div class="glass-card p-4 rounded-4">
                        <h2 class="text-white mb-3">Worker Registration Info</h2>
                        <p class="text-white-50">This section could show summarized registration data or quick access to
                            the profile.</p>
                        <div class="gradient-button mt-3">
                            <a href="#" onclick="showProfileForm(event)"><i class="fa fa-user"></i> Fill Profile</a>
                        </div>
                    </div>
                </div>

                <!-- Second Card -->
                <div class="col-md-6">
                    <div class="glass-card p-4 rounded-4">
                        <h2 class="text-white mb-3">Orders Assigned</h2>
                        <p class="text-white-50">Track how many orders are assigned to you.</p>
                        <a href="track.php" class="btn btn-info mt-3">View Orders</a>


                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Hidden Registration Section -->
    <div id="registrationSection" style="display: none;">
        <?php include 'register.php'; ?>
    </div>

    <!-- Scripts -->
    <script>
        function showProfileForm(event) {
            event.preventDefault();
            document.getElementById('mainContent').style.display = 'none';
            document.getElementById('registrationSection').style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>