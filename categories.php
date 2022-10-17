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
            <div class="main-header ">
                <div class="header-top ">
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
                                            <input type="text" name="Search"
                                                placeholder="Search book by author or publisher">
                                            <div class="search-icon">
                                                <i class="ti-search"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="header-info-right d-flex align-items-center">
                                        <ul>
                                            <li><a href="#">FAQ</a></li>
                                            <li><a href="#">Track Order</a></li>
                                            <li class="shopping-card">
                                                <a href="cart.html"><img src="assets/img/icon/cart.svg" alt=""></a>
                                            </li>
                                            <li><a href="login.html" class="btn header-btn">Sign in</a></li>
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
                                    <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu text-center d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="categories.php">Categories</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="login.html">login</a></li>
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="book-details.html">book Details</a></li>
                                                    <li><a href="blog_details.html">Blog Details</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="contact.html">Contect</a></li>
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
    <main>
        <!-- Hero area Start-->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Book Category</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Hero area End -->
        <!-- listing Area Start -->
        <div class="listing-area pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <!--? Left content -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <!-- Job Category Listing start -->
                        <div class="category-listing mb-50">
                            <form action="" method="GET">
                                <!-- single one -->
                                <div class="single-listing">
                                    <!-- select-Categories  -->
                                    <div class="select-Categories pb-30">
                                        <div class="small-tittle mb-20">
                                            <h4>Filter by Categories</h4>
                                        </div>
                                        <?php
                                        include("dbconnection.php");
                                    $categoryQuery = "SELECT * FROM bookcategory";
                                    $categoryQueryRun = mysqli_query($con,$categoryQuery);

                                    if(mysqli_num_rows($categoryQueryRun) > 0){
                                        foreach($categoryQueryRun as $categoryList){
                                            $checked = [];
                                            if(isset($_GET['categories'])){
                                                $checked = $_GET['categories'];
                                            }
                                            ?>
                                        <label class="container">
                                            <input type="checkbox" name="categories[]"
                                                value="<?= $categoryList['bookCategoryID'];?>"
                                                <?php if(in_array($categoryList['bookCategoryID'],$checked)){ echo "checked"; } ?> />
                                            <?= $categoryList['bookCategoryName']; ?>
                                            <span class="checkmark"></span>
                                        </label>
                                        <?php
                                        }
                                    }
                                    else{
                                        echo "No Categories Found";
                                    }
                                ?>
                                    </div>
                                    <h5><button type="submit" class="btn btn-primary">Filter</button></h5>
                                    <!-- select-Categories End -->
                                </div>
                        </div>
                        </form>
                        <!-- Job Category Listing End -->
                    </div>
                    <!--?  Right content -->
                    <div class="col-xl-8 col-lg-8 col-md-6">
                        <div class="row justify-content-end">
                            <div class="col-xl-4">
                                <div class="product_page_tittle">
                                </div>
                            </div>
                        </div>
                        <div class="best-selling p-0">
                            <div class="row">
                                <?php
                        if(isset($_GET['categories'])){
                            $categoryChecked = [];
                            $categoryChecked = $_GET['categories'];
                            foreach($categoryChecked as $rowCategory){
                                // echo $rowCategory;
                                $booksSql = "SELECT * FROM books WHERE bookCategoryID IN ($rowCategory)";

                                if($booksResult = mysqli_query($con,$booksSql)){
                                    if(mysqli_num_rows($booksResult) > 0){
                                        while($row = mysqli_fetch_assoc($booksResult)){
                                            echo '<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">'
                                                    . '<div class="properties pb-30">'
                                                        . '<div class="properties-card">'
                                                            . '<div class="properties-img">'
                                                                . '<a href="book-details.php?id='.$row['bookID'].'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookImage']).'" alt="">'
                                                                . '</a>'
                                                            . '</div>'
                                                            . '<div class="properties-caption properties-caption2">'
                                                                . '<h3><a href="book-details.php?id='.$row['bookID'].'">'.$row['bookName'].'</a>'
                                                                . '</h3>'
                                                                . '<p>'.$row['bookAuthor'].''
                                                                . '</p>'
                                                                . '<div class="properties-footer d-flex justify-content-between align-items-center">'
                                                                    . '<div class="review">'
                                                                        . '<div class="rating">'
                                                                            . '<i class="fas fa-star"></i>'
                                                                            . '<i class="fas fa-star"></i>'
                                                                            . '<i class="fas fa-star"></i>'
                                                                            . '<i class="fas fa-star"></i>'
                                                                            . '<i class="fas fa-star-half-alt"></i>'
                                                                        . '</div>'
                                                                        . '<p>(<span>120</span> Review)</p>'
                                                                    . '</div>'
                                                                    . '<div class="price">'
                                                                        . '<span>$'.$row['price'].'</span>'
                                                                    . '</div>'
                                                                . '</div>'
                                                            . '</div>'
                                                        . '</div>'
                                                    . '</div>'
                                                . '</div>';
                                        }
                                    }
                                }
                            }
                        }
                        else{

                        $booksSql = "SELECT * FROM books";

                        if($booksResult = mysqli_query($con,$booksSql)){
                            if(mysqli_num_rows($booksResult) > 0){
                                while($row = mysqli_fetch_assoc($booksResult)){
                                    echo '<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">'
                                            . '<div class="properties pb-30">'
                                                . '<div class="properties-card">'
                                                    . '<div class="properties-img">'
                                                        . '<a href="book-details.php?id='.$row['bookID'].'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookImage']).'" alt="">'
                                                        . '</a>'
                                                    . '</div>'
                                                    . '<div class="properties-caption properties-caption2">'
                                                        . '<h3><a href="book-details.php?id='.$row['bookID'].'">'.$row['bookName'].'</a>'
                                                        . '</h3>'
                                                        . '<p>'.$row['bookAuthor'].''
                                                        . '</p>'
                                                        . '<div class="properties-footer d-flex justify-content-between align-items-center">'
                                                            . '<div class="review">'
                                                                . '<div class="rating">'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star-half-alt"></i>'
                                                                . '</div>'
                                                                . '<p>(<span>120</span> Review)</p>'
                                                            . '</div>'
                                                            . '<div class="price">'
                                                                . '<span>$'.$row['price'].'</span>'
                                                            . '</div>'
                                                        . '</div>'
                                                    . '</div>'
                                                . '</div>'
                                            . '</div>'
                                        . '</div>';
                                }
                            }
                        }
                    }
                        ?>
                            </div>
                        </div>
                        <!-- button -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="more-btn text-center mt-15">
                                    <a href="#" class="border-btn border-btn2 more-btn2">Browse More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- listing-area Area End -->

        <!-- Subscribe Area Start -->
        <section class="subscribe-area">
            <div class="container">
                <div class="subscribe-caption text-center  subscribe-padding section-img2-bg"
                    data-background="assets/img/gallery/section-bg1.jpg">
                    <div class="row justify-content-center">

                        <div class="col-xl-6 col-lg-8 col-md-9">
                            <h3>Join Newsletter</h3>
                            <p>Lorem started its journey with cast iron (CI) products in 1980. The initial main
                                objective was to ensure pure water and affordable irrigation.</p>
                            <form action="#">
                                <input type="text" placeholder="Enter your email">
                                <button class="subscribe-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscribe Area End -->
    </main>
    <footer>
        <div class="footer-wrappper section-bg">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-25">
                                        <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Get the breathing space now, and we’ll extend your term at the other end
                                                year for go.</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Book Category</h4>
                                    <ul>
                                        <li><a href="#">History</a></li>
                                        <li><a href="#">Horror - Thriller</a></li>
                                        <li><a href="#">Love Stories</a></li>
                                        <li><a href="#">Science Fiction</a></li>
                                        <li><a href="#">Business</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>&nbsp;</h4>
                                    <ul>
                                        <li><a href="#">Biography</a></li>
                                        <li><a href="#">Astrology</a></li>
                                        <li><a href="#">Digital Marketing</a></li>
                                        <li><a href="#">Software Development</a></li>
                                        <li><a href="#">Ecommerce</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Site Map</h4>
                                    <ul class="mb-20">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i
                                        class="fa fa-heart color-danger" aria-hidden="true"></i> by <a
                                        href="https://colorlib.com" style="color: black" target="_blank"
                                        rel="nofollow noopener">Colorlib</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

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