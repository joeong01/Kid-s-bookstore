<?php
session_start();
include('dbconnection.php');
$SQLAll = mysqli_query($con,"SELECT * FROM books");
//count total number of records
$countAll = mysqli_num_rows($SQLAll);
//fetch records
while ($row = mysqli_fetch_array($SQLAll)) {
  $showAll[] = $row; //to display records in tables using foreach loop
}

$sql = $con->query("SELECT * FROM bookCategory");
$countBC = mysqli_num_rows($sql);
while($row = mysqli_fetch_array($sql)) {
  $bookCategoryArr[] = $row; 
}

$sql = $con->query("SELECT * FROM tags");
$countT = mysqli_num_rows($sql);
while($row = mysqli_fetch_array($sql)) {
  $tags[] = $row; 
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
                                <th style="display: none;">ID</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Book Name</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Book Author</th>
                                <th>&nbsp <span class="fa fa-file-text-o"></span>&nbsp Book Description</th>
                                <th>&nbsp <span class="fa fa-list"></span>&nbsp Book Category</th>
                                <th>&nbsp <span class="fa fa-calendar"></span>&nbsp Published Date</th>
                                <th>&nbsp <span class="fa fa-money"></span>&nbsp Price (RM)</th>
                                <th>&nbsp <span class="fa fa-list"></span>&nbsp Tags</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                  foreach ($showAll as $row) {
                  ?>
                            <tr>
                                <td style="display: none;"><?php echo $row['bookID'];?></td>
                                <td><?php echo $row['bookName'];?></td>
                                <td><?php echo $row['bookAuthor'];?></td>
                                <td><?php echo $row['bookDescription'];?></td>
                                <td><?php 
                                $bookCatid = $row['bookCategoryID'];
                                $sql = $con->query("SELECT bookCategoryName FROM bookcategory WHERE bookCategoryID = $bookCatid");                              
                                $bookCatName = $sql->fetch_assoc();                
                                echo $bookCatName['bookCategoryName'];?>
                                <td><?php echo $row['publishedDate'];?></td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php 
                                $tagsID = $row['tagsID'];
                                  $sql = $con->query("SELECT tagsName FROM tags WHERE tagsID = $tagsID");
                                  $tagsName = $sql->fetch_assoc();                                 
                                  echo $tagsName['tagsName'];
                                ?></td>
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
    <?php echo '<script>var categories = '.json_encode($bookCategoryArr) .';</script>'; ?>
    <?php echo '<script>var tags = '.json_encode($tags) .';</script>'; ?>
    <script>
    $(document).ready(function() {
        console.log(categories);

        var count = tags.length;

        var tagsoptions = "{";

        var i;
        for (i = 0; i < count; i++) {
            tagsoptions += '"';
            tagsoptions += tags[i]["tagsName"];
            tagsoptions += '": "';
            tagsoptions += tags[i]["tagsName"];
            tagsoptions += '"';
            if (i < (count - 1)) {
                tagsoptions += ', ';
            } else {
                tagsoptions += '}';
            }
        }
        console.log(tagsoptions);

        var countcat = categories.length;

        var catoptions = "{";

        var j;
        for (j = 0; j < countcat; j++) {
            catoptions += '"';
            catoptions += categories[j]["bookCategoryName"];
            catoptions += '": "';
            catoptions += categories[j]["bookCategoryName"];
            catoptions += '"';
            if (j < (countcat - 1)) {
                catoptions += ', ';
            } else {
                catoptions += '}';
            }
        }
        console.log(catoptions);


        $('#editable_table').Tabledit({
            url: 'bookdetailsaction.php',
            columns: {
                identifier: [0, 'bookID'],
                editable: [
                    [1, 'bookName'],
                    [2, 'bookAuthor'],
                    [3, 'bookDescription'],
                    [4, 'bookCategory', catoptions],
                    [5, 'publishedDate'],
                    [6, 'price'],
                    [7, 'tags', tagsoptions]
                ]
            },
            onDraw: function() {
                $('table tr td:nth-child(6) input ').each(function() {
                    $(this).datepicker({
                        format: 'yyyy-mm-dd',
                        endDate: '+0d',
                        todayHighlight: false,
                        autoclose: true
                    });
                });
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
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>