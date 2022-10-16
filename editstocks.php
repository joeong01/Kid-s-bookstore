<?php
session_start();
include('dbconnection.php');
$SQLAll = mysqli_query($con,"SELECT * FROM stocks");
//count total number of records
$countAll = mysqli_num_rows($SQLAll);
//fetch records
while ($row = mysqli_fetch_array($SQLAll)) {
  $showAll[] = $row; //to display records in tables using foreach loop
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
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.min.js"></script>
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
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Book Name</th>
                                <th>&nbsp <span class="fa fa-list"></span>&nbsp Stock Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                  foreach ($showAll as $row) {
                  ?>
                            <tr>
                                <td><?php 
                                $bookID = $row['bookID'];
                                $sql = $con->query("SELECT bookName FROM books WHERE bookID = $bookID");                              
                                $bookName = $sql->fetch_assoc();                
                                echo $bookName['bookName'];?>
                                <td><?php echo $row['stockNumber'];?></td>
                            </tr>
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
    $(document).ready(function() {

        $('#editable_table').Tabledit({
            url: 'stocksaction.php',
            deleteButton: false,
            columns: {
                identifier: [0, 'bookID'],
                editable: [
                    [1, 'stockNumber']
                ]
            },
            onDraw: function() {
                console.log(' onDraw()');
            },
            onSuccess: function(data, textStatus, jqXHR) {
                console.log('onSuccess(data, textStatus, jqXHR)');
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
            },
            onFail: function(jqXHR, textStatus, errorThrown) {
                console.log('onFail(jqXHR, textStatus, errorThrown)');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            },
            onAlways: function() {
                console.log(' onAlways()');
            },
            onAjax: function(action, serialize) {
                console.log('onAjax(action, serialize)');
                console.log(action);
                console.log(serialize);
            }
        });
    });
    </script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>