<?php
// BACKEND SECTION (PHP)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['worker_name'])) {
    header("Location: workerdashboard.php");
    exit();
}
$workerName = $_SESSION['worker_name'];

$host = "localhost";
$username = "root";
$password = "";
$database = "project_pbl";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['first_name'])) {
    $firstName = $conn->real_escape_string($_POST['first_name']);
    $lastName = $conn->real_escape_string($_POST['last_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $city = $conn->real_escape_string($_POST['city']);
    $workerType = isset($_POST['worker_type']) ? $conn->real_escape_string($_POST['worker_type']) : '';
    $price = isset($_POST['price']) ? $conn->real_escape_string($_POST['price']) : '';

    $profileImage = "";
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['profileImage']['name']);
        $profileImage = $uploadDir . $fileName;
        if (!move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImage)) {
            die("Error uploading image.");
        }
    }

    $sql = "INSERT INTO reg (first_name, last_name, phone, email, city, worker_type, price, profile_image)
            VALUES ('$firstName', '$lastName', '$phone', '$email', '$city', '$workerType', '$price', '$profileImage')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Glassmorphism Registration</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            color: white;
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-label,
        .step-icon {
            color: #ffffff;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffffff;
            color: white;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .btn {
            border-radius: 12px;
            font-weight: 500;
        }

        .progress {
            background-color: rgba(255, 255, 255, 0.1);
            height: 25px;
            border-radius: 12px;
            overflow: hidden;
        }

        .progress-bar {
            font-size: 14px;
            font-weight: bold;
            line-height: 25px;
            background-color: rgba(72, 239, 255, 0.6);
            color: black;
            text-align: center;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 15px;
            cursor: pointer;
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.6);
            display: none;
            position: absolute;
        }

        .profile-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            color: #fff;
            border: 3px dashed rgba(255, 255, 255, 0.4);
            position: absolute;
            z-index: 1;
        }

        .profile-container input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
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
        }
    </style>
</head>

<body>
    <header class="header-area">
        <div class="container">
            <nav class="main-nav">
                <a href="w.php" class="logo"><?php echo htmlspecialchars($workerName); ?>(Worker)</a>
                <ul class="nav">
                    <li><a href="workerdashboard.php" class="active">Dashboard</a></li>
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

    <div class="container">

        <div class="card">
            <div class="card-header text-center">
                <h4>Worker Registration</h4>
            </div>
            <div class="card-body">
                <div class="progress mb-4">
                    <div id="progressBar" class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33"
                        aria-valuemin="0" aria-valuemax="100">Step 1 of 3</div>
                </div>
                <form id="registrationForm" method="POST" enctype="multipart/form-data">
                    <div class="step active" id="step1">
                        <h5><i class="bi bi-person step-icon"></i> Personal Info</h5>
                        <div class="mb-3">
                            <div class="profile-container">
                                <div class="profile-placeholder" id="profilePlaceholder">+</div>
                                <img id="profilePic" alt="Profile picture" class="profile-pic">
                                <input type="file" id="profileImage" name="profileImage" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                            <label for="firstName" class="form-label mt-3">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required
                                placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required
                                placeholder="Last name">
                        </div>
                    </div>

                    <div class="step" id="step2">
                        <h5><i class="bi bi-envelope step-icon"></i> Contact Info</h5>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Phone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="step" id="step3">
                        <h5><i class="bi bi-geo-alt step-icon"></i> Work Info</h5>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required placeholder="City">
                        </div>

                        <div class="mb-3">
                            <label for="worker_type" class="form-label">Worker Type</label>
                            <select class="form-control text-black" id="worker_type" name="worker_type" required>
                                <option value="" disabled selected>Select Worker Type</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Plumbing">Plumbing</option>
                                <option value="Grocery">Grocery</option>
                                <option value="Sweeper">Sweeper</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Pests Control">Pests Control</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required
                                placeholder="e.g. 500">
                        </div>
                    </div>


                    <div class="step-buttons">
                        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)"
                            disabled>Previous</button>
                        <button type="button" class="btn btn-primary" id="nextBtn"
                            onclick="validateStep()">Next</button>
                        <button type="submit" class="btn btn-success d-none" id="submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function validateStep() {
            const stepFields = document.querySelectorAll(`.step:nth-of-type(${currentStep}) input`);
            let valid = true;
            stepFields.forEach(field => {
                if (!field.checkValidity()) {
                    valid = false;
                    field.classList.add("is-invalid");
                } else {
                    field.classList.remove("is-invalid");
                }
            });
            if (valid) changeStep(1);
        }

        function changeStep(step) {
            const steps = document.querySelectorAll('.step');
            steps[currentStep - 1].classList.remove('active');
            currentStep += step;
            steps[currentStep - 1].classList.add('active');

            document.getElementById('prevBtn').disabled = currentStep === 1;
            document.getElementById('nextBtn').classList.toggle('d-none', currentStep === steps.length);
            document.getElementById('submitBtn').classList.toggle('d-none', currentStep !== steps.length);

            const progress = (currentStep / steps.length) * 100;
            const bar = document.getElementById('progressBar');
            bar.style.width = `${progress}%`;
            bar.setAttribute('aria-valuenow', progress);
            bar.textContent = `Step ${currentStep} of ${steps.length}`;
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('profilePic');
                const placeholder = document.getElementById('profilePlaceholder');
                output.src = reader.result;
                output.style.display = 'block';
                placeholder.style.display = 'none';
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>

</html>