<?php
session_start();

$worker_name = $_SESSION['worker_name'] ?? 'N/A';
$worker_price = $_SESSION['worker_price'] ?? 'N/A';
$worker_city = $_SESSION['worker_city'] ?? 'N/A';
$worker_type = $_SESSION['worker_type'] ?? 'N/A';
$worker_email = $_SESSION['worker_email'] ?? 'N/A';
$worker_image = $_SESSION['worker_image'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Template</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }

        .pdf-container {
            background-color: white;
            padding: 30px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        p {
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #777;
        }

        img {
            max-width: 180px;
            border-radius: 8px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="pdf-container" id="pdfContent">
    <h1>Service Booking Confirmation</h1>

    <p><strong>Worker Name:</strong> <?= htmlspecialchars($worker_name) ?> (<?= htmlspecialchars($worker_type) ?>)</p>
    <p><strong>Service Charge:</strong> ₹<?= htmlspecialchars($worker_price) ?> / per service</p>
    <p><strong>City:</strong> <?= htmlspecialchars($worker_city) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($worker_email) ?></p>

    <?php if ($worker_image): ?>
        <p><strong>Worker Photo:</strong><br>
            <img id="workerImg" src="<?= htmlspecialchars($worker_image) ?>" alt="Worker Image">
        </p>
    <?php endif; ?>

    <p>
        Thank you for choosing our platform to book your service. This is a confirmation of your appointment with
        our professional worker. Please ensure you're available at the given time and location.
    </p>

    <div class="footer">
        &copy; 2025 DP Home Maintenance service. All rights reserved.
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    window.onload = function () {
        const img = document.getElementById('workerImg');
        const generatePDF = () => {
            const element = document.getElementById('pdfContent');
            html2pdf().set({
                margin: 0.5,
                filename: 'booking-confirmation.pdf',
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            }).from(element).save();
        };

        if (img) {
            if (img.complete) {
                generatePDF();
            } else {
                img.onload = generatePDF;
                img.onerror = generatePDF; // fallback
            }
        } else {
            generatePDF();
        }
    };
</script>
</body>
</html>
