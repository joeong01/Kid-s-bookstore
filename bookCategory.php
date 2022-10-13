<?php
session_start();
error_reporting(0);
//include("adminheader.php");
include("dbconnection.php");
	
if (isset($_POST['deleteCategories'])) {
	$categoryID = $_POST['categoryID'];
	$sqlDel = "DELETE FROM bookcategory WHERE bookCategoryID='$categoryID'";
	$resultDel = mysqli_query($con,$sqlDel);

	if ($resultDel) {
		echo "<script>alert('The book category has been deleted.');</script>";
		echo "<script>window.location.href='bookCategory.php'</script>";
	}
	else {
		echo "<script>alert('Something went wrong. Please try again.');</script>";
	}
}	

// if (strlen($_SESSION['detsuid']==0)) {
// 	header('location:logout.php');
// }
// else{
if(isset($_POST['submit']))	{
	$categoryname = trim($_POST['categoryname']);
	if (!empty($categoryname)) {
		$checkDuplicateSql = mysqli_query($con, "SELECT COUNT(*) AS total from bookcategory WHERE bookCategoryName='$categoryname'");
		$row1 = mysqli_fetch_assoc($checkDuplicateSql);
		$found = $row1['total'];

		if ($found == 0) {
			$result = mysqli_query($con, "SELECT COUNT(*) AS total from bookcategory");
			$row = mysqli_fetch_assoc($result);
			$id = $row['total'] + 1;

			$query = mysqli_query($con,
				"INSERT INTO bookcategory(bookCategoryID, bookCategoryName) VALUE ('$id', '$categoryname')"
			);

			if($query){
				echo "<script>alert('Book category has been added!');</script>";
				echo "<script>window.location.href='bookCategory.php'</script>";
			}
			else {
				echo "<script>alert('Something went wrong. Please try again.');</script>";
			}
		}
		else {
			echo "<script>alert('This category already exists.');</script>";
		}
	}
	else {
		echo "<script>alert('Category name cannot be blank.');</script>";
	}
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
    <?php include("adminheader.php"); ?>
    <main>
        <!--  services-area start-->
        <div class="services-area2 top-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <!-- title -->
                            <div class="col-xl-12">
                                <div class="section-tittle d-flex justify-content-between align-items-center mb-40">
                                    <h2 class="mb-0">Book Category</h2>
                                </div>
                                <!------------------------------------->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <p style="font-size:16px; color:red" align="center">
                                                    <!-- ?php -->
                                                    <!-- // if($msg){
                                                // echo $msg;
                                                // } -->
                                                    <!-- ? -->
                                                </p>

                                                <form role="form" method="post" action="">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="categoryname"
                                                                value="" required="true">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div style="text-align: center;" class="form-group has-success">
                                                            <button type="submit" class="btn btn-primary"
                                                                name="submit"><i class="fa fa-plus fa-lg"></i>&nbsp
                                                                ADD</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div><!-- /.panel-body-->
                                        </div><!-- /.panel-->
                                    </div><!-- /.col-->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table id="exp_cat_table"
                                                class="table table-stripped table-hover table-bordered">
                                                <thead>
                                                    <tr style="display: none;">
                                                    </tr>
                                                </thead>
                                                <tbody class="category">
                                                    <?php
														$sql = $con->query("SELECT bookCategoryID, bookCategoryName FROM bookcategory");
														while($data = $sql->fetch_array()) {
															$identifiers = $data['bookCategoryID'] . ";" . $data['bookCategoryName'];								
													?>
                                                    <tr data-index="<?php echo $data['bookCategoryID'];?>">
                                                        <td style="display: none;"><?php echo $identifiers;?></td>
                                                        <td
                                                            style="vertical-align: middle; border-right: solid 1px transparent;">
                                                            <?php echo $data['bookCategoryName'];?></td>
                                                        <td
                                                            style="vertical-align: middle; border-right: solid 1px transparent;">
                                                            <?php 
															$sqlTransactions = mysqli_query($con,"SELECT * FROM books WHERE bookCategoryID='".$data['bookCategoryID']."'");
															$count = mysqli_num_rows($sqlTransactions);
															echo "$count books";
								  							?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.panel-body -->
                                    </div><!-- /.panel -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <!--./row-->
                    </div>
                </div>
                <!--./row-->
            </div>
        </div>
    </main>


    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {
        $('#exp_cat_table').Tabledit({
            url: 'exp-table-action.php',
            columns: {
                identifier: [0, 'identifiers'],
                editable: [
                    [1, 'bookCategoryName']
                ]
            },
            onDraw: function() {
                console.log('onDraw()');
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
                console.log('onAlways()');
            },
            onAjax: function(action, serialize) {
                console.log('onAjax(action, serialize)');
                console.log(action);
                console.log(serialize);
            }
        });
    });
    </script>

    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>


    <?php
//include("adminfooter.php");
?>

</body>

</html>