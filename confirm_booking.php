<?php
$worker_id = $_GET['worker_id'] ?? '';
$worker_name = $_GET['worker_name'] ?? '';
$worker_email = $_GET['worker_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
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
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

<div class="glass-card p-6 w-96 max-w-full">
    <h2 class="text-xl font-semibold mb-4">Confirm Booking for <?= htmlspecialchars($worker_name) ?></h2>

    <input type="hidden" id="bookingWorkerId" value="<?= htmlspecialchars($worker_id) ?>" />
    <input type="hidden" id="bookingWorkerName" value="<?= htmlspecialchars($worker_name) ?>" />
    <input type="hidden" id="bookingWorkerEmail" value="<?= htmlspecialchars($worker_email) ?>" />

    <input type="text" id="userLocation" placeholder="Enter your address"
           class="w-full px-4 py-2 mb-4 border border-white/20 rounded"/>

    <div class="flex justify-end gap-2">
        <a href="javascript:history.back()"
           class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
            Cancel
        </a>
        <button onclick="submitBooking()"
                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Confirm Booking
        </button>
    </div>
</div>

<script>
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
            window.location.href = "index.php"; // Or redirect wherever you want
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to confirm booking.');
        });
    }
</script>

</body>
</html>
