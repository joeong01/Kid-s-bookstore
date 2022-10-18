<?php
    include("userHeader.php");
    include("dbconnection.php");
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
                        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Book Category</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Hero area End -->
        <!-- listing Area Start -->
        <div class="listing-area pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <!--? Left content -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <!-- Job Category Listing start -->
                        <div class="category-listing mb-50">
                            <form action="" method="GET">
                                <!-- single one -->
                                <div class="single-listing">
                                    <!-- select-Categories  -->
                                    <div class="select-Categories pb-30">
                                        <div class="small-tittle mb-20">
                                            <h4>Filter by Categories</h4>
                                        </div>
                                        <?php
                                    $categoryQuery = "SELECT * FROM bookcategory";
                                    $categoryQueryRun = mysqli_query($con,$categoryQuery);

                                    if(mysqli_num_rows($categoryQueryRun) > 0){
                                        foreach($categoryQueryRun as $categoryList){
                                            $checked = [];
                                            if(isset($_GET['categories'])){
                                                $checked = $_GET['categories'];
                                            }
                                            ?>
                                        <label class="container">
                                            <input type="checkbox" name="categories[]"
                                                value="<?= $categoryList['bookCategoryID'];?>"
                                                <?php if(in_array($categoryList['bookCategoryID'],$checked)){ echo "checked"; } ?> />
                                            <?= $categoryList['bookCategoryName']; ?>
                                            <span class="checkmark"></span>
                                        </label>
                                        <?php
                                        }
                                    }
                                    else{
                                        echo "No Categories Found";
                                    }
                                ?>
                                    </div>
                                    <h5><button type="submit" class="btn btn-primary">Filter</button></h5>
                                    <!-- select-Categories End -->
                                </div>
                        </div>
                        </form>
                        <!-- Job Category Listing End -->
                    </div>
                    <!--?  Right content -->
                    <div class="col-xl-8 col-lg-8 col-md-6">
                        <div class="row justify-content-end">
                            <div class="col-xl-4">
                                <div class="product_page_tittle">
                                </div>
                            </div>
                        </div>
                        <div class="best-selling p-0">
                            <div class="row">
                                <?php
                        if(isset($_GET['categories'])){
                            $categoryChecked = [];
                            $categoryChecked = $_GET['categories'];
                            foreach($categoryChecked as $rowCategory){
                                // echo $rowCategory;
                                $booksSql = "SELECT * FROM books WHERE bookCategoryID IN ($rowCategory)";

                                if($booksResult = mysqli_query($con,$booksSql)){
                                    if(mysqli_num_rows($booksResult) > 0){
                                        while($row = mysqli_fetch_assoc($booksResult)){
                                            echo '<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">'
                                                    . '<div class="properties pb-30">'
                                                        . '<div class="properties-card">'
                                                            . '<div class="properties-img">'
                                                                . '<a href="book-details.php?id='.$row['bookID'].'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookImage']).'" alt="">'
                                                                . '</a>'
                                                            . '</div>'
                                                            . '<div class="properties-caption properties-caption2">'
                                                                . '<h3><a href="book-details.php?id='.$row['bookID'].'">'.$row['bookName'].'</a>'
                                                                . '</h3>'
                                                                . '<p>'.$row['bookAuthor'].''
                                                                . '</p>'
                                                                . '<div class="properties-footer d-flex justify-content-between align-items-center">'
                                                                    . '<div class="price">'
                                                                        . '<span>$'.$row['price'].'</span>'
                                                                    . '</div>'
                                                                . '</div>'
                                                            . '</div>'
                                                        . '</div>'
                                                    . '</div>'
                                                . '</div>';
                                        }
                                    }
                                }
                            }
                        }
                        else{

                        $booksSql = "SELECT * FROM books";

                        if($booksResult = mysqli_query($con,$booksSql)){
                            if(mysqli_num_rows($booksResult) > 0){
                                while($row = mysqli_fetch_assoc($booksResult)){
                                    echo '<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">'
                                            . '<div class="properties pb-30">'
                                                . '<div class="properties-card">'
                                                    . '<div class="properties-img">'
                                                        . '<a href="book-details.php?id='.$row['bookID'].'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookImage']).'" alt="">'
                                                        . '</a>'
                                                    . '</div>'
                                                    . '<div class="properties-caption properties-caption2">'
                                                        . '<h3><a href="book-details.php?id='.$row['bookID'].'">'.$row['bookName'].'</a>'
                                                        . '</h3>'
                                                        . '<p>'.$row['bookAuthor'].''
                                                        . '</p>'
                                                        . '<div class="properties-footer d-flex justify-content-between align-items-center">'
                                                            . '<div class="review">'
                                                                . '<div class="rating">'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star"></i>'
                                                                    . '<i class="fas fa-star-half-alt"></i>'
                                                                . '</div>'
                                                                . '<p>(<span>120</span> Review)</p>'
                                                            . '</div>'
                                                            . '<div class="price">'
                                                                . '<span>$'.$row['price'].'</span>'
                                                            . '</div>'
                                                        . '</div>'
                                                    . '</div>'
                                                . '</div>'
                                            . '</div>'
                                        . '</div>';
                                }
                            }
                        }
                    }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- listing-area Area End -->

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
