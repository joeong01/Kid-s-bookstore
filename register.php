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
    <!-- header end -->
    <main class="login-bg">
        <?php
            session_start();
            require "internal/dbconnect.php";

            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $getUser = mysqli_query($con,"SELECT * FROM customer WHERE email = '$email' ");
                $queryRun = mysqli_fetch_array($getUser);

                if($queryRun > 0){
                    echo "<script> alert('Email already Registered');</script>";
                }
                else {
                    $query = mysqli_query($con, "INSERT INTO customer(full_name, email, password) value('$name', '$email', '$password')");
                    echo "<script> alert('Registered Successly!');</script>";
                    $query = mysqli_query($con, "INSERT INTO shoppingcart(totalItems,totalPrice) value(NULL, NULL)");
                    $query = mysqli_query($con, "UPDATE shoppingcart SET customerID = cartID WHERE customerID IS NULL");
                    header('Location: http://localhost/Kid-s-bookstore/userLogin.php');
                }
                
            }
        ?>
        <!-- Register Area Start -->
        <div class="register-form-area">
            <div class="register-form text-center">
                <!-- Login Heading -->
                <div class="register-heading">
                    <span>Sign Up</span>
                    <p>Create your account to get full access</p>
                </div>
                <!-- Single Input Fields -->
                <form method="post">
                    <div class="input-box">
                        <div class="single-input-fields">
                            <label>Full name</label>
                            <input type="text" placeholder="Enter full name" id="name" name="name" required>
                        </div>
                        <div class="single-input-fields">
                            <label>Email Address</label>
                            <input type="email" placeholder="Email address" id="email" name="email" pattern='[a-zA-Z0-9_]+@+[a-z]+.com' title='Example_1@example.com'  required>
                        </div>
                        <div class="single-input-fields">
                            <label>Password</label>
                            <input type="password" placeholder="Enter Password" id="password" name="password" required>
                        </div>
                        <div class="single-input-fields">
                            <label>Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" id="conPassword" name="conPassword" onkeyup='check();' required>
                            <span id='message'></span>
                        </div>
                    </div>
                    <!-- form Footer -->
                    <div class="register-footer">
                        <p> Already have an account? <a href="userLogin.php"> Login</a> here</p>
                        <button type="submit" id="sure" name="submit" class="submit-btn3">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Register Area End -->
    </main>

    <script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('conPassword').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Matching with password';
            document.getElementById('sure').disabled = false;
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not matching with password';
            document.getElementById('sure').disabled = true;
        }
    }
    </script>
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