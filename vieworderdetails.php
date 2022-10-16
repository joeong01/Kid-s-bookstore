<?php
session_start();
include('dbconnection.php');

$SQLAll = mysqli_query($con,"SELECT * FROM `order`");
//count total number of records
$countAll = mysqli_num_rows($SQLAll);
//fetch records
while ($row = mysqli_fetch_array($SQLAll)) {
  $showOrder[] = $row; //to display records in tables using foreach loop
}

$SQLAll = mysqli_query($con,"SELECT * FROM orderDetails");
//count total number of records
$countDetails = mysqli_num_rows($SQLAll);
//fetch records
while ($row = mysqli_fetch_array($SQLAll)) {
  $showDetails[] = $row; //to display records in tables using foreach loop
}

$sql = $con->query("SELECT * FROM orderstatus");
$countBC = mysqli_num_rows($sql);
while($row = mysqli_fetch_array($sql)) {
  $orderstatus[] = $row; 
}
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <?php define('PAGE', 'Manage books') ?>
    <?php include("adminheader.php"); ?>
    <main>
        <!-- Blog Area Start -->
        <section class="blog_area single-post-area section-padding">
            <div class="container">
                <div class="col-md-12">
                    <table id="editable_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Order ID</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Customer ID</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Total Items</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Total Price (RM)</th>
                                <th>&nbsp <span class="fa fa-list"></span>&nbsp Order Date</th>
                                <th>&nbsp <span class="fa fa-calendar"></span>&nbsp Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                  foreach ($showOrder as $row) {
                  ?>
                            <tr class="clicker">
                                <td><?php echo $row['orderID'];?></td>
                                <td><?php echo $row['customerID'];?></td>
                                <td><?php echo $row['totalItems'];?></td>
                                <td><?php echo $row['totalPrice'];?></td>
                                <td><?php echo $row['orderDate'];?></td>
                                <td><?php 
                                $statusID = $row['statusID'];
                                $sql = $con->query("SELECT `status` FROM `orderstatus` WHERE statusID = $statusID");                              
                                $statusName = $sql->fetch_assoc();                
                                echo $statusName['status'];?>
                            </tr>
                            <tr>
                                <th style="display: none;">&nbsp <span class="fa fa-file-text-o"></span>&nbsp Order ID
                                </th>
                                <th colspan="2">&nbsp <span class="fa fa-file-text-o"></span>&nbsp Book ID</th>
                                <th colspan="2">&nbsp <span class="fa fa-file-text-o"></span>&nbsp Number of Books</th>
                                <th colspan="2">&nbsp <span class="fa fa-file-text-o"></span>&nbsp Total Price per Item
                                    (RM)</th>
                            </tr>
                            <?php 
                                    foreach ($showDetails as $sd){
                                        if ($sd['orderID'] == $row['orderID']){
                                            ?>
                            <tr>
                                <td style="display: none;"><?php echo $sd['orderID'];?></td>
                                <td colspan="2"><?php echo $sd['bookID'];?></td>
                                <td colspan="2"><?php echo $sd['numberOfBooks'];?></td>
                                <td colspan="2"><?php echo $sd['totalPriceOfOne'];?></td>
                            </tr>
                            <?php } } ?>

                            <?php
                  }
                  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Blog Area End -->
    </main>
    <script>
    $('.clicker').click(function() {
        $(this).nextUntil('.clicker').slideToggle('normal');
    });
    </script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>