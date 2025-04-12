<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "project_pbl";

// Create DB connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get city from GET param
$city = isset($_GET['city']) ? $conn->real_escape_string($_GET['city']) : '';
$query = "SELECT * FROM reg WHERE city LIKE '%$city%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Workers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .worker-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .worker-card:hover {
            transform: translateY(-4px);
        }

        .image-box img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid white;
        }

        .info-box {
            flex-grow: 1;
            padding: 0 1.5rem;
        }

        .info-box h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 0.3rem;
        }

        .info-box p {
            margin: 4px 0;
            color: #ddd;
        }

        .info-box .price {
            color: #90ee90;
            font-weight: 500;
        }

        .action-box {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-btn {
            background: #22c55e;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .book-btn:hover {
            background: #16a34a;
            transform: scale(1.05);
        }

        .no-results {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 3rem;
            color: #ccc;
        }

        @media (max-width: 600px) {
            .worker-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-box {
                padding: 1rem 0;
            }

            .action-box {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()):
                $worker_id = $row['id'];
                $worker_name = htmlspecialchars($row['first_name'] . " " . $row['last_name']);
                $worker_city = htmlspecialchars($row['city']);
                $worker_type = htmlspecialchars($row['worker_type']);
                $worker_image = htmlspecialchars($row['profile_image']);
                $worker_price = htmlspecialchars($row['price']);
                ?>
                <div class="worker-card">
                    <div class="image-box">
                        <img src="<?= $worker_image ?>" alt="Worker Image">
                    </div>

                    <div class="info-box">
                        <h2><?= $worker_name ?></h2>
                        <p><i class="fas fa-map-marker-alt"></i> <?= $worker_city ?></p>
                        <p>Type: <?= $worker_type ?></p>
                        <p class="price">₹<?= $worker_price ?> / service</p>
                    </div>

                    <div class="action-box">
                        <a href="set_session.php?worker_id=<?= urlencode($worker_id) ?>" class="book-btn">BOOK</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-results">No workers found in this city.</p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php $conn->close(); ?>