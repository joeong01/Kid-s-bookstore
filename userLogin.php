<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <main class="login-bg">
        <!-- login Area Start -->
        <div class="login-form-area">
            <?php
                session_start();
                require "internal/dbconnect.php";
                if(isset($_POST['submit'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $getUser = mysqli_query($con,"SELECT * FROM customer WHERE email = '$email' AND password = '$password' ");
                    $queryRun = mysqli_fetch_array($getUser);

                    if($queryRun > 0){
                        $_SESSION["id"] = $queryRun['customerID'];
                        echo "<script> alert('LogIn successfuly');</script>";
                        header('Location: http://localhost/Kid-s-bookstore/index.php');
                    }
                    else{
                        echo "<script> alert('Email or password incorrect');</script>";
                    }

                }
            ?>
            <div class="login-form">
                <!-- Login Heading -->
                <form method="post">
                    <div class="login-heading">
                        <span>Login</span>
                        <p>Enter Login details to get access</p>
                    </div>
                    <!-- Single Input Fields -->
                    <div class="input-box">
                        <div class="single-input-fields">
                            <label>Email Address</label>
                            <input type="email" placeholder="Email address" id="email" name="email" pattern='[a-zA-Z0-9_]+@+[a-z]+.com' title='Example_1@example.com' required>
                        </div>
                        <div class="single-input-fields">
                            <label>Password</label>
                            <input type="password" placeholder="Enter Password" id="password" name="password" required>
                        </div>
                    </div>
                    
                    <!-- form Footer -->
                    <div class="login-footer">
                        <p>Don’t have an account? <a href="register.php">Sign Up</a> here.</p>
                        <button name="cancel" class="submit-btn3"><a href="index.php">Cancel</a></button>
                        <button type="submit" name="submit" class="submit-btn3">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- login Area End -->
    </main>
    <!-- JS here -->
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- Slick-slider , Owl-Carousel ,slick-nav -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!--wow , counter , waypoint, Nice-select -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!--  Plugins, main-Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    </body>
</html>