<?php
session_start();

// Booking Info
$worker_id = $_GET['worker_id'] ?? 'WKR-1023';
$worker_name = $_GET['worker_name'] ?? $_SESSION['worker_name'] ?? 'N/A';
$worker_price = $_SESSION['worker_price'] ?? 'N/A';
$worker_city = $_SESSION['worker_city'] ?? 'N/A';
$worker_type = $_SESSION['worker_type'] ?? 'N/A';
$worker_email = $_GET['worker_email'] ?? $_SESSION['worker_email'] ?? 'N/A';
$worker_image = $_SESSION['worker_image'] ?? '';

// DB Connection
$conn = new mysqli("localhost", "root", "", "project_pbl");

// Tracking Info
$status = 'Assigned';
$result = $conn->query("SELECT status FROM tracking_status WHERE worker_id='$worker_id'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['status'];
}
$status_map = ['Assigned' => 0, 'On the Way' => 1, 'Arrived' => 2];
$active_index = $status_map[$status] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking & Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg') no-repeat center center / cover;
            min-height: 100vh;
            padding: 40px 15px;
            font-family: Arial, sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(14px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .glass-card input {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .glass-card input::placeholder {
            color: #ccc;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline-primary {
            background-color: transparent;
            color: #4bb8a9;
            border: 1.3px solid #4bb8a9;
        }

        #progressbar {
            margin-top: 30px;
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 33.33%;
            float: left;
            text-align: center;
            position: relative;
        }

        #progressbar li:before {
            content: "";
            display: block;
            background: #ccc;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin: auto;
            margin-bottom: 5px;
        }

        #progressbar li:after {
            content: '';
            height: 2px;
            background: #ccc;
            position: absolute;
            width: 100%;
            left: -50%;
            top: 12px;
            z-index: -1;
        }

        #progressbar li:first-child:after {
            content: none;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #4bb8a9;
        }
    </style>
</head>

<body class="pt-24">

    <!-- Navbar -->
    <nav
        class="fixed top-0 left-0 w-full z-50 bg-white/10 backdrop-blur-md border-b border-white/20 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-xl font-bold">
                <a href="#" class="hover:text-green-300 transition">DP Home Services</a>
            </div>
            <ul class="hidden md:flex space-x-6 text-sm font-medium">
                <li><a href="#" class="hover:text-green-400 transition">Home</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Services</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Contact</a></li>
            </ul>
            <div class="md:hidden">
                <button id="menuToggle" class="text-white focus:outline-none focus:ring">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobileMenu" class="md:hidden hidden px-4 pb-3">
            <a href="#" class="block py-2 text-sm hover:text-green-300">Home</a>
            <a href="#" class="block py-2 text-sm hover:text-green-300">Services</a>
            <a href="#" class="block py-2 text-sm hover:text-green-300">Contact</a>
        </div>
    </nav>

    <!-- Booking Section -->
    <div id="bookingCard" class="flex justify-center mb-10">
        <div class="glass-card p-6 w-96 max-w-full">
            <h2 class="text-xl font-semibold mb-4">Confirm Booking for <?= htmlspecialchars($worker_name) ?></h2>
            <input type="hidden" id="bookingWorkerId" value="<?= htmlspecialchars($worker_id) ?>" />
            <input type="hidden" id="bookingWorkerName" value="<?= htmlspecialchars($worker_name) ?>" />
            <input type="hidden" id="bookingWorkerEmail" value="<?= htmlspecialchars($worker_email) ?>" />
            <input type="text" id="userLocation" placeholder="Enter your address"
                class="w-full px-4 py-2 mb-4 border border-white/20 rounded" />
            <div class="flex justify-end gap-2">
                <a href="javascript:history.back()"
                    class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">Cancel</a>
                <button onclick="submitBooking()"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Confirm Booking</button>
            </div>
        </div>
    </div>

    <!-- Tracking Section -->
    <div id="trackingSection" style="display:none;" class="container-fluid d-sm-flex justify-content-center">
        <div class="card p-4 w-100 max-w-4xl">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col">
                        <p class="text-muted">Worker ID <span
                                class="font-weight-bold text-dark"><?= $worker_id ?></span></p>
                        <p class="text-muted">Joined On <span class="font-weight-bold text-dark">04 April 2025</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="media flex-column flex-sm-row align-items-center">
                    <div class="media-body">
                        <h5 class="bold">Name: <?= $worker_name ?> (<?= $worker_type ?>)</h5>
                        <h4 class="mt-3 mb-4 bold">&#x20B9; <?= $worker_price ?> <span class="small text-muted">/ per
                                service</span></h4>
                        <p class="text-muted">Location: <?= $worker_city ?></p>
                        <p class="text-muted">Email: <?= $worker_email ?></p>
                        <p class="text-muted">Current Status: <strong id="currentStatus"><?= $status ?></strong></p>
                        <button type="button" class="btn btn-outline-primary" onclick="downloadPDF()">Download
                            Receipt</button>
                    </div>
                    <img class="align-self-center img-fluid rounded ml-sm-4 mt-4 mt-sm-0" src="<?= $worker_image ?>"
                        width="200" height="200">
                </div>
            </div>
            <div class="row px-3">
                <div class="col">
                    <ul id="progressbar">
                        <li class="<?= $active_index >= 0 ? 'active' : '' ?>">Assigned</li>
                        <li class="<?= $active_index >= 1 ? 'active' : '' ?>">On the Way</li>
                        <li class="<?= $active_index >= 2 ? 'active' : '' ?>">Arrived</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden PDF Content -->
    <div id="pdfContent" style="display:none;">
        <h1>Service Booking Confirmation</h1>
        <p><strong>Worker Name:</strong> <?= htmlspecialchars($worker_name) ?> (<?= htmlspecialchars($worker_type) ?>)
        </p>
        <p><strong>Service Charge:</strong> ₹<?= htmlspecialchars($worker_price) ?> / per service</p>
        <p><strong>City:</strong> <?= htmlspecialchars($worker_city) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($worker_email) ?></p>
        <?php if ($worker_image): ?>
            <p><strong>Worker Photo:</strong><br><img src="<?= htmlspecialchars($worker_image) ?>" alt="Worker Image"
                    style="max-width: 180px;"></p>
        <?php endif; ?>
        <p>Thank you for choosing our platform to book your service. Please ensure you're available at the scheduled
            time.</p>
        <div class="footer" style="text-align:center; margin-top:20px; font-size:12px;">&copy; 2025 DP Home Maintenance
            service. All rights reserved.</div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('menuToggle').addEventListener('click', () => {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        function submitBooking() {
            const workerId = document.getElementById('bookingWorkerId').value;
            const workerName = document.getElementById('bookingWorkerName').value;
            const workerEmail = document.getElementById('bookingWorkerEmail').value;
            const userLocation = document.getElementById('userLocation').value.trim();

            if (!userLocation) {
                alert("Please enter your address.");
                return;
            }

            fetch('book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    worker_id: workerId,
                    worker_name: workerName,
                    worker_email: workerEmail,
                    location: userLocation
                })
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    document.getElementById("bookingCard").style.display = "none";
                    document.getElementById("trackingSection").style.display = "flex";
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to confirm booking.');
                });
        }

        function downloadPDF() {
            const element = document.getElementById('pdfContent');
            element.style.display = 'block';
            const img = element.querySelector('img');
            const generate = () => {
                html2pdf().set({
                    margin: 0.5,
                    filename: 'booking-confirmation.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
                }).from(element).save().then(() => {
                    element.style.display = 'none';
                });
            };
            if (img) {
                img.complete ? generate() : (img.onload = generate, img.onerror = generate);
            } else generate();
        }

        function updateProgress() {
            fetch('get_status.php')
                .then(response => response.text())
                .then(status => {
                    document.getElementById("currentStatus").innerText = status;
                    const steps = ["Assigned", "On the Way", "Arrived"];
                    const activeIndex = steps.indexOf(status.trim());
                    const lis = document.querySelectorAll("#progressbar li");
                    lis.forEach((li, index) => {
                        if (index <= activeIndex) li.classList.add("active");
                        else li.classList.remove("active");
                    });
                });
        }

        setInterval(updateProgress, 3000);
        updateProgress();
    </script>

</body>

</html>