<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Glassmorphism Registration + Nav</title>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script> <!-- ✅ Tailwind added -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- ...rest -->


    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar - Glassmorphism */
        .header-area {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-nav .nav {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
        }

        .main-nav .nav li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
        }

        .main-nav .gradient-button a {
            background: linear-gradient(to right, #ff5858, #f09819);
            padding: 8px 15px;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        h1 {
            color: #fff;
            font-weight: 800;
        }

        .search-container {
            max-width: 700px;
            margin: 40px auto;
            position: relative;
        }

        .search-container input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border-radius: 50px;
            border: none;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            color: white;
            font-size: 1.2rem;
        }

        .search-container input::placeholder {
            color: #ddd;
        }

        .search-container button {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background-color: #ff4f81;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #results {
            margin: 50px auto;
            max-width: 1000px;
            color: white;
            padding: 20px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
        }

        /* Fade-in animation */
        .animate-fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar for results */
        #results::-webkit-scrollbar {
            height: 8px;
        }

        #results::-webkit-scrollbar-thumb {
            background: #ffffff66;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <header class="header-area">
        <div class="container">
            <nav class="main-nav">
                <a href="#" class="logo">
                    <img src="assets/images/logo.png" alt="Logo" height="40">
                </a>
                <ul class="nav">
                    <li><a href="#top">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#newsletter">Newsletter</a></li>
                    <li>
                        <div class="gradient-button">
                            <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Search Section -->
    <div class="container text-center mt-5 animate-fade-in">
      
        <div class="search-container mt-4">
            <input type="text" id="cityInput" placeholder="Enter city name">
            <button onclick="fetchElectricians()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Results Section -->
    <div id="results" class="animate-fade-in"></div>

    <!-- JS Script -->
    <script>
        function fetchElectricians() {
            const city = document.getElementById('cityInput').value.trim();
            const resultsDiv = document.getElementById('results');

            if (city === '') {
                resultsDiv.innerHTML = '<p class="text-center text-light">Please enter a city.</p>';
                return;
            }

            resultsDiv.innerHTML = '<p class="text-center text-light">Searching...</p>';

            fetch(`fetchdata.php?city=${encodeURIComponent(city)}`)
                .then(response => response.text())
                .then(data => {
                    resultsDiv.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    resultsDiv.innerHTML = '<p class="text-center text-danger">Error fetching data.</p>';
                });
        }

    </script>

</body>

</html>