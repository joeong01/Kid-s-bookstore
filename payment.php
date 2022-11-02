<?php
    include("dbconnection.php");
    session_start();

    $custID = $_SESSION['id'];

    $getCartSql = "SELECT * FROM shoppingCart WHERE customerID=$custID";

    $result = mysqli_query($con, $getCartSql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
    
    $cart_id = $row['cartID'];
    $totalItems = $row['totalItems'];
    $totalPrice = $row['totalPrice'];

    $getCartSql = "SELECT MAX(orderID) AS num FROM `order`";

    $result = mysqli_query($con, $getCartSql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }

    $max = $row['num'] + 1;
    
    $addOrderSql = "INSERT INTO `order` (orderID, customerID, totalItems, totalPrice, statusID)
    VALUES ($max, $custID, $totalItems, $totalPrice, 1)";
    
    mysqli_query($con, $addOrderSql);

    $getCartDetailSql = "SELECT * FROM shoppingCartDetails WHERE cartID=$cart_id";

    $result = mysqli_query($con, $getCartDetailSql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $bookID = $row['bookID'];
            $booknum = $row['numberOfBooks'];
            $bookPrice = $row['totalPriceOfOne'];

            $addOrderDetailSql = "INSERT INTO orderDetails (orderID, bookID, numberOfBooks, totalPriceOfOne)
            VALUES ($max, $bookID, $booknum, $bookPrice)";

            mysqli_query($con, $addOrderDetailSql);
        }
    }

    $cardName = $_POST['cardName'];
    $cardType = $_POST['cardType'];
    $expcard = $_POST['expDate'];
    $cvv = $_POST['cvv'];
    $cardNum = $_POST['cardNumber'];

    $addPaymentSql = "INSERT INTO payment (customerID, `nameOnCard`, `cardType`, `cardExpireDate`, `cvv`, `cardNumber`)
    VALUES ($custID, '$cardName', '$cardType', '$expcard', $cvv, $cardNum)";

    mysqli_query($con, $addPaymentSql);

    $updateCart = "UPDATE shoppingCart SET totalItems = 0, totalPrice = 0.00
    WHERE cartID=$cart_id";

    mysqli_query($con, $updateCart);

    $deleteCartDetails = "DELETE FROM shoppingcartdetails WHERE cartID=$cart_id";

    mysqli_query($con, $deleteCartDetails);

    echo '<script>if(!alert("Payment has been successfully made. Order is placed.")) document.location=\'index.php\'; </script>';
    exit;
?>