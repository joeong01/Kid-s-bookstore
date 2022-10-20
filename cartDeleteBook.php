<?php
    include("dbconnection.php");

    $bookID = $_GET['bookId'];

    $cart_id = $_GET['cartId'];

    $num = $_GET['num'];

    $price = $_GET['price'];

    $totalPrice = $num * $price;

    $updateCart = "UPDATE shoppingCart SET totalItems = totalItems - $num, totalPrice = totalPrice - $totalPrice
    WHERE cartID=$cart_id";

    $result = mysqli_query($con, $updateCart);

    $deleteBookSql = "DELETE FROM shoppingCartDetails 
        WHERE cartID=$cart_id AND bookID=$bookID";

    $result = mysqli_query($con, $deleteBookSql);

    header('Location: cart.php');

    exit;
?>