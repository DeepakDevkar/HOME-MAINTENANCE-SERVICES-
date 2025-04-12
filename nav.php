<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FixMate - Home Service Portal</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Embedded Custom CSS -->
  <style>
    :root {
        font-size: 125%;
    }
    
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 1em;
        line-height: 1.618;
        margin: 0;
        padding: 0;
        color: #224;
        background: url('https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg') center / cover no-repeat fixed;
    }

    /* Header */
    #a1 {
        background-color: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(15px);
        padding: 20px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .a2 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .a4 {
        list-style: none;
        display: flex;
        gap: 30px;
        margin: 0;
        padding: 0;
    }

    .a4 li a {
        text-decoration: none;
        color: #223;
        font-weight: 500;
    }

    .a4 li a:hover {
        color: #f09819;
        transition: color 0.3s ease;
    }

    .a5 {
        background: linear-gradient(to right, #ff5858, #f09819);
        padding: 8px 15px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
    }

    .a3 img {
        height: 40px;
    }

    /* Cards */
    .site-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        min-height: 100vh;
        padding: 2rem;
        place-items: center;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
        max-width: 300px;
        height: 300px;
        padding: 35px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.45);
        box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(15px);
    }

    .card-footer {
        font-size: 0.65em;
        color: #446;
    }

    p {
        margin: 0 0 1.5em;
    }

    /* Modal Trigger Button */
    .open-modal-btn {
        padding: 15px 30px;
        background: linear-gradient(135deg, #ff4b2b, #ff416c);
        border: none;
        color: white;
        border-radius: 30px;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
    }
  </style>
</head>

<body>
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <header id="a1">
    <div class="container">
      <nav class="a2">
        <a href="index.php" class="a3">
          <img src="assets/images/logo.png" alt="FixMate Logo">
        </a>
        <ul class="a4">
          <li><a href="#top" class="active">Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li><a href="#newsletter">Newsletter</a></li>
          <li>
            <a href="#" class="open-modal-btn a5" id="openModal">Log in</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
