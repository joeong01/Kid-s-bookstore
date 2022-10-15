<?php
session_start();
error_reporting(0);
include('dbconnection.php');
if(isset($_POST['submit']))
{
  $bookID = $_POST['bookID'];
  $bookName = $_POST['bookName'];
  $bookAuthor = $_POST['bookAuthor'];
  $bookDescription = $_POST['bookDescription'];
  $bookCategoryID = $_POST['bookCategory'];
  $publishedDate = $_POST['publishedDate'];
  $price = $_POST['price'];
  $tagsID = $_POST['tags'];
  $stockLevel = $_POST['stockLevel'];
  $bookCoverImage = file_get_contents($_FILES['bookCoverImage']['tmp_name']);

  $valid = true;
  $msg = "";


  if (empty($bookID)) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Please fill in book ISBN number.";
    $valid = false;
}

if (!empty($bookID)){
$SQLAll = mysqli_query($con,"SELECT * FROM books");
//count total number of records
$countAll = mysqli_num_rows($SQLAll);
//fetch records
while ($row = mysqli_fetch_array($SQLAll)) {
  $showAll[] = $row; //to display records in tables using foreach loop
  if ($bookID == $row['bookID']){
    $msg .= "Book already exist.";
    $valid = false;
  }
}
}


if (empty($bookName)) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Please fill in book name.";
    $valid = false;
}

if (empty($bookAuthor)) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Please fill in book author.";
    $valid = false;
}

  if (empty($bookCategoryID)) {
	  if (!empty($msg)) {
		  $msg .= "<br/>";
	  }
	  $msg .= "Please select a Category.";
	  $valid = false;
  }

  if (empty($tagsID)) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Please select a Tag.";
    $valid = false;
}

  if (!is_numeric($bookID) || ($bookID <= 0)) {
	  if (!empty($msg)) {
		  $msg .= "<br/>";
	  }
	  $msg .= "Invalid ISBN Number entered.";
	  $valid = false;
  }

  if (!is_numeric($price) || ($price <= 0)) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Invalid price amount entered.";
    $valid = false;
}

if ($stockLevel <= 0) {
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $msg .= "Invalid stock amount entered." + $stockLevel;
    $valid = false;
}

if(!isset($_FILES['bookCoverImage']['tmp_name'])){
    if (!empty($msg)) {
        $msg .= "<br/>";
    }
    $valid = false;
    $msg = "Please select an image";
}

  if ($valid == true) {
    
        $sql="INSERT INTO books(`bookID`, `bookName`, `bookAuthor`,`bookDescription`, `bookCategoryID`, `publishedDate`, `price`, `tagsID`)
        VALUE ('$bookID', '$bookName','$bookAuthor','$bookDescription','$bookCategoryID','$publishedDate','$price','$tagsID')";
	  $query = mysqli_query($con,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($con), E_USER_ERROR);;

      $imgData = file_get_contents($_FILES['bookCoverImage']['tmp_name']);
 
        $sql2 = "UPDATE books SET `bookImage` = (?) WHERE bookID = '$bookID'";
        $statement = $con->prepare($sql2);
        $statement->bind_param('s', $imgData);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());

        $sql2="INSERT INTO stocks(`bookID`, `stockNumber`)
        VALUE ('$bookID', '$stockLevel')";
	    $query2 = mysqli_query($con,$sql2) or trigger_error("Query Failed! SQL: $sql2 - Error: ".mysqli_error($con), E_USER_ERROR);;

	  if($query){
		echo "<script>alert('Book has been added!');</script>";
		echo "<script>window.location.href='addBook.php'</script>";
	  }

	  else {
		echo "<script>alert('Something went wrong. Please try again.');</script>";     
        echo "<script>window.location.href='addBook.php'</script>";
	  }
  }

}

?>

<!DOCTYPE html>
<html>

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
</head>

<body>
    <?php include_once('adminheader.php');?>
    <main>
        <div class="col-sm-9" style="position: absolute;left: 10%">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#D4D4D4;">Add Books</div>
                </div>
            </div>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><span class="fa fa-book"></span>&nbsp Book ID(ISBN)</label>
                                    <input class="form-control" type="text" name="bookID" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-bars"></span>&nbsp Book Name</label>
                                    <input class="form-control" type="text" name="bookName" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-user-o "></span>&nbsp Book Author</label>
                                    <input class="form-control" type="text" name="bookAuthor" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-image"></span>&nbsp Book Cover Image</label>
                                    <input class="form-control" type="file" accept="image/*" name="bookCoverImage"
                                        required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-align-justify"></span>&nbsp Book Description</label>
                                    <input class="form-control" type="text" name="bookDescription" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-list"></span>&nbsp Book Category</label>
                                    <select class="form-control" name="bookCategory">
                                        <option value="" selected="true" disabled="disabled">SELECT CATEGORY</option>
                                        <?php
					$sql = $con->query("SELECT * FROM bookcategory");
					while($data = $sql->fetch_array()) {
						echo "<option value='".$data['bookCategoryID']."'>".$data['bookCategoryName']."</option>";
					}
				  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-calendar"></span>&nbsp Published Date</label>
                                    <input class="form-control" type="date" name="publishedDate" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-money"></span>&nbsp Price (RM)</label>
                                    <input class="form-control" type="text" name="price" required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-list"></span>&nbsp Tags</label>
                                    <select class="form-control" name="tags">
                                        <option value="" selected="true" disabled="disabled">SELECT TAG</option>
                                        <?php
					$sql = $con->query("SELECT * FROM tags");
					while($data = $sql->fetch_array()) {
                        echo "<option value='".$data['tagsID']."'>".$data['tagsName']."</option>";
					}
				  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><span class="fa fa-money"></span>&nbsp Stock Level</label>
                                    <input class="form-control" type="number" name="stockLevel" required="true">
                                </div>

                                <?php
					if($msg){
						echo "<p style='color:red;'>";
						echo $msg;
						echo "</p>";
					}
				?>
                                <br>
                                <div align="center" class="form-group has-success">
                                    <button type="submit" class="btn btn-primary" name="submit"
                                        style="width: 50%;">ADD</button>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </form>

                    </div><!-- /.panel-body-->
                </div><!-- /.panel-->
            </div><!-- /.col-->
        </div>
        <!--/.main-->
    </main>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>