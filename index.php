<?php
    include("userHeader.php");
    include("dbconnection.php");
?>
<main>
    <!-- slider Area Start-->
    <div class="slider-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-active dot-style">
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg1 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Science</h1>
                                            <a href="http://localhost/Kid-s-bookstore/categories.php?categories%5B%5D=101" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg4 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Plant</h1>
                                            <a href="http://localhost/Kid-s-bookstore/categories.php?categories%5B%5D=102" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg3 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Language</h1>
                                            <a href="http://localhost/Kid-s-bookstore/categories.php?categories%5B%5D=103" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slider slider-height slider-bg2 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Comic</h1>
                                            <a href="http://localhost/Kid-s-bookstore/categories.php?categories%5B%5D=104" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slider slider-height slider-bg5 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Animal</h1>
                                            <a href="http://localhost/Kid-s-bookstore/categories.php?categories%5B%5D=105" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <hr style="height:0px;border-width:0px;color:transparent;">
    <!-- Best Selling start -->
    <div class="best-selling section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Best Selling Books Ever</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="selling-active">
                        <?php
                            $BestSale = "SELECT * FROM books INNER JOIN tags ON books.tagsID = tags.tagsID WHERE tags.tagsName = 'Best Sale'";
                            $queryRun = mysqli_query($con,$BestSale);

                            foreach($queryRun as $item){
                        ?>
                        <div class="properties pb-20">
                            <div class="properties-card">
                                <div class="properties-img">
                                    <?php echo "
                                        <a href='http://localhost/Kid-s-bookstore/book-details.php?id=$item[bookID]'>";
                                            echo '<img height=300px width=200px src= "data:image/jpeg;base64,'. base64_encode($item['bookImage']).'"/>';
                                        echo "</a>";
                                    ?>
                                </div>
                                <div class="properties-caption">
                                    <?php echo "
                                    <p>$item[bookName]</p>
                                    <div class='properties-footer d-flex justify-content-between align-items-center'>
                                        <div class='price'>
                                            <span>RM $item[price]</span>
                                        </div>
                                    </div>
                                    " ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr style="height:0px;border-width:0px;color:transparent;">
    <!-- Latest-items Start -->
    <div class="best-selling section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>New Release</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="selling-active">
                        <?php
                            $newRelease = "SELECT * FROM books INNER JOIN tags ON books.tagsID = tags.tagsID WHERE tags.tagsName = 'New Release'";
                            $queryRun = mysqli_query($con,$newRelease);

                            foreach($queryRun as $item){
                        ?>
                        <div class="properties pb-20">
                            <div class="properties-card">
                                <div class="properties-img">
                                    <?php echo "
                                        <a href='http://localhost/Kid-s-bookstore/book-details.php?id=$item[bookID]'>";
                                            echo '<img height=300px width=200px src= "data:image/jpeg;base64,'. base64_encode($item['bookImage']).'"/>';
                                        echo "</a>";
                                    ?>
                                </div>
                                <div class="properties-caption">
                                    <?php echo "
                                    <p>$item[bookName]</p>
                                    <div class='properties-footer d-flex justify-content-between align-items-center'>
                                        <div class='price'>
                                            <span>RM $item[price]</span>
                                        </div>
                                    </div>
                                    " ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest-items End -->
</main>
<?php
    include("footer.php")
?>

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