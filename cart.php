<?php
    include("userHeader.php");
    include("dbconnection.php");

    $custID = $_SESSION["id"];

    $getCartSql = "SELECT * FROM shoppingCart WHERE customerID=$custID";

    $result = mysqli_query($con, $getCartSql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
    
    $cart_id = $row['cartID'];
    $totalPrice = $row['totalPrice'];

    //get book from shoppingcartdetails
    $getBookSql = "SELECT shoppingCartDetails.numberOfBooks, shoppingCartDetails.totalPriceOfOne, shoppingCartDetails.bookID, books.bookImage , books.bookName 
    FROM shoppingCartDetails 
    INNER JOIN books ON shoppingCartDetails.bookID = books.bookID
    WHERE cartID=$cart_id";

    $result = mysqli_query($con, $getBookSql);

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

<main>
    <!-- Hero area Start-->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slider-area">
                    <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                        <div class="hero-caption hero-caption2">
                            <h2>Cart</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--  Hero area End -->
    <!--================Cart Area =================-->
    <section class="cart_area section-padding">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>'
                                        .'<td>'
                                            .'<div class="media">'
                                                .'<div class="d-flex">'
                                                    .'<a href="book-details.php?id='.$row['bookID'].'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookImage']).'" alt=""></a>'
                                                .'</div>'
                                                .'<div class="media-body">'
                                                    .'<p>'.$row['bookName'].'</p>'
                                                .'</div>'
                                            .'</div>'
                                        .'</td>'
                                        .'<td>'
                                            .'<h5>RM'.$row['totalPriceOfOne'].'</h5>'
                                        .'</td>'
                                        .'<td>'
                                            .'<h5>'.$row['numberOfBooks'].'</h5>'
                                        .'</td>'
                                        .'<td>'
                                            .'<h5>RM'.$row['totalPriceOfOne']*$row['numberOfBooks'].'</h5>'
                                        .'</td>'
                                        .'<td>'
                                            .'<a href="cartDeleteBook.php?bookId='.$row['bookID'].'&cartId='.$cart_id.'&num='.$row['numberOfBooks'].'&price='.$row['totalPriceOfOne'].'"><h5>Delete</h5></a>'
                                        .'</td>'
                                    .'</tr>';
                                }
                            }
                            ?>
                            <!-- <tr class="bottom_button">
                                <td>
                                    <a class="btn" href="#">Update Cart</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text float-right">
                                        <a class="btn" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <?php echo '<h5>RM '.$totalPrice.' </h5>' ?>
                                </td>
                            </tr>
                            <!-- <tr class="shipping_area">
                                <td></td>
                                <td></td> -->
                                <!-- <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box"> -->
                                        <!-- <form>
                                            Flat Rate: $5.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                            
                                            Free Shipping
                                            <input type="radio" aria-label="Radio button for following text input">
                                            
                                            Flat Rate: $10.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                            
                                            Local Delivery: $2.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </form>
                                        <h6>
                                            Calculate Shipping
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </h6> -->
                                        <!-- <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select section_bg">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                                        <a class="btn" href="#">Update Details</a> -->
                                    <!-- </div>
                                </td> -->
                            <!-- </tr> -->
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn" href="index.php">Continue Shopping</a>
                        <a class="btn checkout_btn" href="checkout.php">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
</main>
<?php
    include("footer.php")
?>

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