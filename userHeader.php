<?php
session_start();
require "internal/dbconnect.php";
?>
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
    <header>
        <div class="header-area">
            <div class="main-header">
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="d-flex justify-content-between align-items-center flex-sm">
                                    <div class="header-info-left d-flex align-items-center">
                                        <!-- logo -->
                                        <div class="logo">
                                            <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                                        </div>
                                        <!-- Search Box -->
                                        <form action="#" class="form-box">
                                            <input type="text" name="search" onkeyup="showResult(this.value)"
                                                id="search" size="10" placeholder="Search book by author or publisher">
                                            <!-- <div class="search-icon"><i class="ti-search"></i></div> -->
                                            <div id="results"
                                                style="font-size: 20px; z-index: 10; background-color: grey; color: black; overflow: auto; max-height: 400px; min-height: fit-content; min-width: 530px; max-width: fit-content; position: absolute;">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="header-info-right d-flex align-items-center">
                                        <ul>
                                            <li>
                                                <?php
                                                if(isset($_SESSION["id"])){
                                            ?>
                                                <a href="cart.php"><img src="assets/img/icon/cart.svg" alt=""></a>
                                                <?php
                                                }else{
                                            ?>
                                                <a href="userLogin.php"><img src="assets/img/icon/cart.svg" alt=""></a>
                                                <?php
                                                }
                                            ?>
                                            </li>
                                            <?php
                                                if(isset($_SESSION["id"])){
                                            ?>
                                            <li><a href="logOut.php" class="btn header-btn">Log Out</a></li>
                                            <?php
                                                }else{
                                            ?>
                                            <li><a href="userLogin.php" class="btn header-btn">Sign in</a></li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12">
                                <!-- logo 2 -->
                                <div class="logo2">
                                    <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu text-center d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="categories.php">Categories</a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="cart.php">Cart</a></li>
                                                    <?php
                                                        if(isset($_SESSION["id"])){
                                                    ?>
                                                    <li><a href="checkout.php">Checkout</a></li>
                                                    <li><a href="editProfile.php">Edit Profile</a></li>
                                                    <?php
                                                        }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-xl-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
    function showResult(str) {
        if (str.length == 0) {
            document.getElementById("results").innerHTML = "";
            document.getElementById("results").style.border = "0px";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("results").innerHTML = this.responseText;
                document.getElementById("results").style.border = "1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET", "searchData.php?q=" + str, true);
        xmlhttp.send();
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