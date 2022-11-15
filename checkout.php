<?php
    include("userHeader.php");
    include("dbconnection.php");

    $custID = $_SESSION['id'];

    $getCartSql = "SELECT * FROM shoppingCart WHERE customerID=$custID";

    $result = mysqli_query($con, $getCartSql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
    
    $cart_id = $row['cartID'];
    $totalPrice = (float)$row['totalPrice'];

    $getBookSql = "SELECT * , books.bookName
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
                                <h2>Check Out</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Hero area End -->

        <!--? Checkout Area Start-->
        <section class="checkout_area section-padding">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">

                            <h3>Billing Details</h3>
                            <form class="row contact_form" method="post" action="payment.php" novalidate="novalidate">
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="name"
                                        placeholder="First name" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="last" name="name"
                                        placeholder="Last name" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="number"
                                        placeholder="Phone number" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="compemailany"
                                        placeholder="Email Address" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="country" name="country"
                                        placeholder="Country" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add" name="add"
                                        placeholder="Address line" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Town/City" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="zip"
                                        placeholder="Postcode/ZIP" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="State" />
                                </div>

                                <h3>Card Details</h3>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                                        placeholder="Card Number" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="cardName" name="cardName"
                                        placeholder="Cardholder Name" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="expDate" name="expDate"
                                        placeholder="Expiration date" />
                                </div>
                                <h3>Card Type</h3>
                                <input type="radio" id="visa" name="cardType" value="visa" checked="true">
                                <label for="html">VISA</label><br>
                                <input type="radio" id="mastercard" name="cardType" value="mastercard">
                                <label for="css">MasterCard</label><br><br><br>

                                <?php
                                    if(mysqli_num_rows($result) > 0){
                                        echo "<input class='btn w-100' type='submit' value='Proceed to Payment'>";
                                    }
                                    else{
                                        echo "<input class='btn w-100' type='submit' value='Proceed to Payment' disabled>";
                                    }
                                ?>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <h3>Shipping Details</h3>
                                        <div class="checkout-cap">
                                            <input type="checkbox" id="f-option3" name="selector" />
                                            <label for="f-option3">Ship to a different address?</label>
                                        </div>
                                    </div>
                                    <textarea class="form-control" name="message" id="message" rows="1"
                                        placeholder="Order Notes"></textarea>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a>Product<span>Total</span>
                                        </a>
                                    </li>
                                    <?php
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<li>'
                                                .'<a>'.$row['bookName'].''
                                                    .'<span class="middle">x '.$row['numberOfBooks'].'</span>'
                                                    .'<span class="last">'.$row['numberOfBooks']*$row['totalPriceOfOne'].'</span>'
                                                .'</a>'
                                            .'</li>';
                                        }
                                    }
                                ?>
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <?php echo '<a>Subtotal <span>RM '.$totalPrice.'</span></a>' ?>
                                    </li>
                                    <li>
                                        <a>Shipping
                                            <span>Flat rate: RM5</span>
                                        </a>
                                    </li>
                                    <li>
                                        <?php
                                        $tp = $totalPrice + 5.00;
                                    echo '<a>'
                                        .'Total<span>RM '.$tp.'</span>'
                                        .'</a>';
                                    ?>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="selector" />
                                        <label for="f-option5">Check payments</label>
                                        <div class="check"></div>
                                    </div>
                                    <p> Please send a check to Store Name, Store Street, Store Town, Store State /
                                        County, Store Postcode. </p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="selector" />
                                        <label for="f-option6">Paypal </label>
                                        <img src="assets/img/gallery/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p> Please send a check to Store Name, Store Street, Store Town, Store State /
                                        County, Store Postcode. </p>
                                </div>
                                <div class="creat_account checkout-cap">
                                    <input type="checkbox" id="f-option8" name="selector" />
                                    <label for="f-option8">I've read and accept the <a href="#">terms & conditions*</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Checkout Area -->

    </main>
    <?php
    include("footer.php")
?>
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