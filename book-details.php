<?php
require "internal/dbconnect.php";
include("userHeader.php");
$book_id = $_GET['id'];
$bookInfoSql = "SELECT * FROM books WHERE bookID='$book_id'";
$bookInfoResult = mysqli_query($con,$bookInfoSql);
if(mysqli_num_rows($bookInfoResult) > 0)
    $book_info = mysqli_fetch_assoc($bookInfoResult);
?>

<main>
    <!--  services-area start-->
    <div class="services-area2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Single -->
                            <div class="single-services d-flex align-items-center mb-0">
                                <div class="features-img">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($book_info['bookImage']).'" height="450" width="400" alt="">' ?>
                                </div>
                                <div class="features-caption">
                                    <h3><?php echo $book_info['bookName']; ?></h3>
                                    <p>By <?php echo $book_info['bookAuthor']; ?></p>
                                    <div class="price">
                                        <span>$<?php echo $book_info['price']; ?></span>
                                    </div>
                                    <div class="review">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <p>(120 Review)</p>
                                        <br>
                                        <p>Published On: <?php echo $book_info['publishedDate']; ?></p>
                                    </div>
                                    <a href="#" class="white-btn mr-10">Add to Cart</a>
                                    <a href="#" class="border-btn share-btn"><i class="fas fa-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services-area End-->
    <!--Books review Start -->
    <section class="our-client section-padding best-selling">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-10">
                    <div class="nav-button f-left">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true">Description</a>
                                <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="false">Author</a>
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                    <!-- Tab 1 -->  
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p><?php echo $book_info['bookDescription']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                    <!-- Tab 2 -->
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p><?php echo $book_info['bookAuthor']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Books review End -->
    <!-- Subscribe Area Start -->
    <section class="subscribe-area" >
        <div class="container">
            <div class="subscribe-caption text-center  subscribe-padding section-img2-bg" data-background="assets/img/gallery/section-bg1.jpg">
                <div class="row justify-content-center">
                    
                    <div class="col-xl-6 col-lg-8 col-md-9">
                        <h3>Join Newsletter</h3>
                        <p>Lorem started its journey with cast iron (CI) products in 1980. The initial main objective was to ensure pure water and affordable irrigation.</p>
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
                                     <p>Get the breathing space now, and we’ll extend your term at the other end year for go.</p>
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
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" style="color: black"target="_blank" rel="nofollow noopener">Colorlib</a>

                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
</div>
</footer>
<!-- Scroll Up -->
<div id="back-top" >
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