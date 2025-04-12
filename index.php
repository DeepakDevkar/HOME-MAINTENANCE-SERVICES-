<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>Chain App Dev - App Landing Page HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">




    <style>
        .signup-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .signup-modal.show {
            display: flex;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            width: 400px;
            max-width: 90%;
            padding: 30px;
            color: #fff;
        }

        .signup-container input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .signup-container button {
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        .signup-close {
            position: absolute;
            top: 15px;
            right: 25px;
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            width: 800px;
            max-width: 100%;
            min-height: 500px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            padding: 60px 40px;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            opacity: 0;
            z-index: 1;
        }

        .auth-container.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
            z-index: 1;
        }

        .auth-container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 2;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .auth-container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: linear-gradient(to right, rgba(255, 75, 43, 0.4), rgba(255, 65, 108, 0.4));
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 50%;
            padding: 0 40px;
        }

        .overlay-left {
            transform: translateX(-20%);
            left: 0;
        }

        .auth-container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .auth-container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            color: white;
            cursor: pointer;
            z-index: 9999;
        }

        button.ghost {
            background: transparent;
            border: 1px solid white;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 20px;
        }

        #authContainer input {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            color: #fff;
            border-radius: 8px;
            outline: none;
        }

        #authContainer button {
            margin-top: 20px;
            padding: 12px 45px;
            border-radius: 20px;
            border: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #authContainer button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>



</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots"><span></span><span></span><span></span></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo5 (1).png" alt="Chain App Dev">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#services">Services</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>

                            <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
                            <li>
                                <div class="gradient-button">
                                    <a id="openModal"><i class="fa fa-user-plus"></i> Sign In / Sign Up</a>

                                </div>
                            </li>

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <!-- Auth Modal (Sign In / Sign Up) -->
    <div class="modal" id="authModal">
        <div class="close-btn" id="closeModal">&times;</div>
        <div class="auth-container" id="authContainer">
            <div class="form-container sign-up-container">
                <form id="signupForm">
                    <h1>Create Account</h1>
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form id="signinForm">
                    <h1>Sign In</h1>
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <button type="submit">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>If you already have an account, sign in here.</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Start your journey with us by signing up.</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>DP Home Maintenance and Services</h2>
                                        <p>quick and quality service is center is our dp home services . user can book
                                            and order services and grocessary items.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="white-button first-button scroll-to-section">
                                            <a href="rating.html">Rate us <i class="fab fa-apple"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="assets/images/slider-dec.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4>Amazing <em>Services &amp; Features</em> for you</h4>
                        <img src="assets/images/heading-line-dec.png" alt="">

                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <div class="service-item first-service">

                        <a href="search.php">
                            <img src="assets/images/s2.png" alt="Electrical">
                        </a>
                        <h2 class="text-2xl font-bold">Electrical</h2>


                        <div class="text-button">
                            <a href="#">Book Now <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="service-item second-service">

                        <a href="search.php">
                            <img src="assets/images/s3.png" alt="Plumbing">
                        </a>
                        <h2 class="text-2xl font-bold">Plumbing</h2>

                        <div class="text-button">
                            <a href="#">Book Now <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>



                <div class="col-lg-3">
                    <div class="service-item fourth-service">

                        <a href="Grocy_project/testing.php">
                            <img src="assets/images/s5.png" alt="Grocery" class="w-20 h-20 mx-auto">
                        </a>
                        <h2 class="text-2xl font-bold text-center mt-2 hover:text-purple-400 transition duration-200">
                            Grocery
                        </h2>

                        <div class="text-button">
                            <a href="Grocy_project/testing.php">Book Now <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>



                <div class="col-lg-3">
                    <div class="service-item third-service">

                        <a href="search.php">
                            <img src="assets/images/s4.png" alt="Sweeper">
                        </a>
                        <h2 class="text-2xl font-bold">Sweeper</h2>

                        <div class="text-button">
                            <a href="#">Book Now<i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>




                <div class="col-lg-3">
                    <div class="service-item third-service">

                        <a href="search.php">
                            <img src="assets/images/s6.png" alt="Clothing">
                        </a>
                        <h2 class="text-2xl font-bold">Clothing</h2>

                        <div class="text-button">
                            <a href="#">Book Now<i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>



                <div class="col-lg-3">
                    <div class="service-item third-service">
                        <a href="search.php">
                            <img src="assets/images/s1.png" alt="Pests">
                        </a>
                        <h2 class="text-2xl font-bold">Pests Control</h2>

                        <div class="text-button">
                            <a href="search.php">Book Now<i class="fa fa-arrow-right"></i></a>

                        </div>
                    </div>
                </div>








            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="section-heading">
                        <h4>About <em>What We Do</em> &amp; Who We Are</h4>
                        <img src="assets/images/heading-line-dec.png" alt="">
                        <p>we are the team dp home services give our 100 % to fullfill every customers need .</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Safety assurance</a></h4>
                                <p>trusted workers</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">24/7 Support &amp; Help</a></h4>
                                <p>anytime ready</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Cash on delivery</a></h4>
                                <p>pre-payment not needeed</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Quick service</a></h4>
                                <p>quick and fast</p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <p>we are always ready to provide services and Grocery items to users. </p>
                            <div class="gradient-button">
                                <a href="rating.html">Rate us</a>
                            </div>
                            <span>*To improve our services</span>
                        </div>

                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="right-image">
                        <img src="assets/images/about-right-dec.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer id="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4>Join our mailing list to receive the news &amp; latest trends</h4>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-3">
                    <form id="search" action="#" method="GET">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <fieldset>
                                    <input type="address" name="address" class="email" placeholder="Email Address..."
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <fieldset>
                                    <button type="submit" class="main-button">Subscribe Now <i
                                            class="fa fa-angle-right"></i></button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>Contact Us</h4>
                        <p>DP home service</p>
                        <p><a href="#">010-020-0340</a></p>
                        <p><a href="#">DP@company.co</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>About Our Company</h4>
                        <div class="logo">
                            <img src="assets/images/logo5.PNG" alt="">
                        </div>
                        <p>DP Home Services , room no 23, shirgaon kadgegaon,415303 </p>
                    </div>
                </div>

            </div>
        </div>
    </footer>



    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>






    <script>
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const authModal = document.getElementById('authModal');
        const authContainer = document.getElementById('authContainer');
        const signUpBtn = document.getElementById('signUp');
        const signInBtn = document.getElementById('signIn');

        openModal.onclick = () => {
            authModal.classList.add('show');
        };

        closeModal.onclick = () => {
            authModal.classList.remove('show');
            authContainer.classList.remove('right-panel-active');
        };

        signUpBtn.onclick = () => {
            authContainer.classList.add("right-panel-active");
        };

        signInBtn.onclick = () => {
            authContainer.classList.remove("right-panel-active");
        };

        window.onclick = (e) => {
            if (e.target === authModal) {
                authModal.classList.remove('show');
                authContainer.classList.remove('right-panel-active');
            }
        };

        document.getElementById("signupForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("signup.php", {
                method: "POST",
                body: formData
            })
                .then(userss => userss.text())
                .then(data => {
                    alert(data.trim() === "success" ? "Sign Up Successful!" : "Sign Up Failed.");
                });
        });

        document.getElementById("signinForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("signin.php", {
                method: "POST",
                body: formData
            })
                .then(userss => userss.text())
                .then(data => {
                    if (data.trim() === "success") {
                        window.location.href = "w.php";
                    } else {
                        alert("Invalid email or password.");
                    }
                });
        });



    </script>

</body>

</html>