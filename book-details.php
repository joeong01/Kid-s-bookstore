<?php
require "internal/dbconnect.php";
include("userHeader.php");
$book_id = $_GET['id'];
$bookInfoSql = "SELECT * FROM books WHERE bookID='$book_id'";
$bookInfoResult = mysqli_query($con, $bookInfoSql);
if (mysqli_num_rows($bookInfoResult) > 0)
    $book_info = mysqli_fetch_assoc($bookInfoResult);

$book_price = $book_info['price'];


if (isset($_GET['add'])) {
    if (isset($_SESSION["id"])) {
        $custID = $_SESSION["id"];

        //get cart ID
        $getCartSql = "SELECT * FROM shoppingCart WHERE customerID=$custID";

        $result = mysqli_query($con, $getCartSql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

        $cart_id = $row['cartID'];
        $total_items = $row['totalItems'];
        $total_price = $row['totalPrice'];

        //get book from shoppingcartdetails
        $getBookSql = "SELECT * FROM shoppingCartDetails WHERE cartID=$cart_id AND bookID=$book_id";

        $result = mysqli_query($con, $getBookSql);

        //if the book exist, numberofBooks +1
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $numBooks = $row['numberOfBooks'];

            $addBookSql = "UPDATE shoppingCartDetails SET numberOfBooks=$numBooks+1
        WHERE cartID=$cart_id AND bookID=$book_id";

            mysqli_query($con, $addBookSql);

            //update the price and items in the cart
            $addPriceSql = "UPDATE shoppingCart SET totalItems=$total_items+1, totalPrice=$total_price+$book_price
        WHERE cartID=$cart_id ";

            mysqli_query($con, $addPriceSql);
        }
        //else add the book
        else {
            $addBookSql = "INSERT INTO shoppingCartDetails (cartID,bookID,numberOfBooks,totalPriceOfOne) 
        VALUES ($cart_id,$book_id,1,$book_price)";

            mysqli_query($con, $addBookSql);

            //update the price and items in the cart
            $addPriceSql = "UPDATE shoppingCart SET totalItems=$total_items+1, totalPrice=$total_price+$book_price
        WHERE cartID=$cart_id ";

            mysqli_query($con, $addPriceSql);
        }

        echo '<script>alert("Added to cart")</script>';
  }      
    } else {
        echo '<script>alert("Please login to add book to cart.")</script>';
        echo '<script>window.location.href = "userLogin.php"</script>';        
    }
}

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
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($book_info['bookImage']) . '" height="450" width="400" alt="">' ?>
                                </div>
                                <div class="features-caption">
                                    <h3><?php echo $book_info['bookName']; ?></h3>
                                    <p>By <?php echo $book_info['bookAuthor']; ?></p>
                                    <div class="price">
                                        <span>RM<?php echo $book_info['price']; ?></span>
                                    </div>
                                    <div class="review">
                                        <br>
                                        <p>Published On: <?php echo $book_info['publishedDate']; ?></p>
                                    </div>
                                    <?php
                                    echo '<a href="book-details.php?id=' . $book_info['bookID'] . '&add=true" class="white-btn mr-10">Add to Cart</a>'
                                    ?>
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
                                <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one"
                                    role="tab" aria-controls="nav-one" aria-selected="true">Description</a>
                                <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two" role="tab"
                                    aria-controls="nav-two" aria-selected="false">Author</a>
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
</main>
<?php
include("footer.php")
?>
<!-- Scroll Up -->
<div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<script>


</script>
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