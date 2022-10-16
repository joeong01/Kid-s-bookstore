<?php
//start the session
session_start();
//error_reporting(0);
//connect to database
include('dbconnection.php');

//pie chart and double line graph start-------------------------------------------------------------------------------------
//get data from the stock level table
$stocks = $con->query("SELECT * FROM stocks");
//get data from the order table
$order = $con->query("SELECT * FROM `order`");

//get stocks pie chart data start-------------------------------------------------------------------------------------------
//declare as array
$stocksChartDataPoints = array();
$StocksLevelNames = array();
$StocksLevelAmts = array();
$l = 0;
$stocksTotal = 0;
$restock = 0;
$sufficient = 0;
$overstock = 0;

//sql query to get the data in the stocks table
$sqlStocks2 = $con->query("SELECT * FROM stocks");

//while there is data in the incomes table that follows the condition in the query
while ($data = $sqlStocks2->fetch_array()) {
	//get data
	if ($data['stockNumber'] <= 10){
        $restock = $restock + 1;
    } else if ($data['stockNumber'] > 10 && $data['stockNumber'] <= 100){
        $sufficient = $sufficient + 1;
    } else if ($data['stockNumber'] > 100){
        $overstock = $overstock + 1;
    }
}

$stocksTotal = $restock + $sufficient + $overstock;

$percentage = ($restock / $stocksTotal) * 100;
array_push($stocksChartDataPoints, array("label" => "Need to Restock", "y" => $percentage));

$percentage = ($sufficient / $stocksTotal) * 100;
array_push($stocksChartDataPoints, array("label" => "Sufficient", "y" => $percentage));

$percentage = ($overstock / $stocksTotal) * 100;
array_push($stocksChartDataPoints, array("label" => "Overstock", "y" => $percentage));
//get stocks pie chart data end---------------------------------------------------------------------------------------------

//get order pie chart data start------------------------------------------------------------------------------------------
$orderChartDataPoints = array();
$orderStatusNames = array();
$orderStatusAmts = array();
$m = 0;
$orderTotal = 0;
$pending = 0;
$shipped = 0;
$cancelled = 0;
$completed = 0;

//sql query to get the data in the order table
$sqlorder = $con->query("SELECT * FROM `order`");

//while there is data in the order table that follows the condition in the query
while ($data = $sqlorder->fetch_array()) {
    //get data
    if ($data['statusID'] == 1){
        $pending = $pending + 1;
    } else if ($data['statusID'] == 2){
        $shipped = $shipped + 1;
    } else if ($data['statusID'] == 3){
        $cancelled = $cancelled + 1;
    } else if ($data['statusID'] == 4){
        $completed = $completed + 1;
    }
}

$orderTotal = $pending + $shipped + $cancelled + $completed;

$percentage = ($pending / $orderTotal) * 100;
array_push($orderChartDataPoints, array("label" => "Pending", "y" => $percentage));

$percentage = ($shipped / $orderTotal) * 100;
array_push($orderChartDataPoints, array("label" => "Shipped", "y" => $percentage));

$percentage = ($cancelled / $orderTotal) * 100;
array_push($orderChartDataPoints, array("label" => "Cancelled", "y" => $percentage));

$percentage = ($completed / $orderTotal) * 100;
array_push($orderChartDataPoints, array("label" => "Completed", "y" => $percentage));
//get order pie chart data end--------------------------------------------------------------------------------------------
//pie chart and double line graph end---------------------------------------------------------------------------------------

//order table start----------------------------------------------------------------------------------------------------------
//get data from the order table where pending status
$SQLOrderPending = mysqli_query($con, "SELECT * FROM `order` WHERE statusID=1");
//count how many rows of pending data 
$countOrderPending = mysqli_num_rows($SQLOrderPending);
//while there is data that fullfill the conditions in the sql query
while ($row = mysqli_fetch_array($SQLOrderPending)) {
	$showOrderPending[] = $row;
}

//sql query to get data from the order table where shipped status
$SQLOrderShipped = mysqli_query($con, "SELECT * FROM `order` WHERE statusID=2");
//count how many rows of shipped data
$countOrderShipped = mysqli_num_rows($SQLOrderShipped);
//while there is data that fullfill the conditions in the sql query
while ($row = mysqli_fetch_array($SQLOrderShipped)) {
	$showOrderShipped[] = $row;
}

//sql query to get data from the order table where the completed status
$SQLOrderCompleted = mysqli_query($con, "SELECT * FROM `order` WHERE statusID=4");
//count how many rows of completed ata 
$countOrderCompleted = mysqli_num_rows($SQLOrderCompleted);
//while there is data that fullfill the conditions in the sql query
while ($row = mysqli_fetch_array($SQLOrderCompleted)) {
	$showOrderCompleted[] = $row;
}

//order table end------------------------------------------------------------------------------------------------------------
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
        <section class="blog_area single-post-area section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body easypiechart-panel">
                                <h4><b>Pending Orders</b></h4>
                                <div class="easypiechart" id="easypiechart-red" data-percent="100">
                                    <span class="percent">
                                        <?php echo "$countOrderPending"?>
                                    </span>
                                </div>
                            </div><!-- /.panel-body-->
                        </div><!-- /.panel-->
                    </div><!-- /.col-->
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body easypiechart-panel">
                                <h4><b>Shipped Orders</b></h4>
                                <div class="easypiechart" id="easypiechart-orange" data-percent="100">
                                    <span class="percent">
                                        <?php echo "$countOrderShipped"?>
                                    </span>
                                </div>
                            </div><!-- /.panel-body-->
                        </div><!-- /.panel-->
                    </div><!-- /.col-->
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body easypiechart-panel">
                                <h4><b>Completed Orders</b></h4>
                                <div class="easypiechart" id="easypiechart-teal" data-percent="100">
                                    <span class="percent">
                                        <?php echo "$countOrderCompleted"?>
                                    </span>
                                </div>
                            </div><!-- /.panel-body-->
                        </div><!-- /.panel-->
                    </div><!-- /.col-->

                </div><!-- /.row-->

                <!--start of division class 2-->
                <div class="row">
                    <!--start of division class 3-->
                    <div class="col-xs-6 col-md-6">
                        <!--start of division class 4-->
                        <div class="panel panel-default">
                            <center>
                                <br />
                                <!--title-->
                                <h3><b>Stock Level</b></h3>
                                <!--display the chart-->
                                <div id='stocksChartContainer' style='height: 370px; width: 95%;'></div>
                                <br /><br />
                            </center>
                        </div>
                        <!--end of division class 4-->
                    </div>
                    <!--end of division class 3-->

                    <!--start of division class 3-->
                    <div class="col-xs-6 col-md-6">
                        <!--start of division class 4-->
                        <div class="panel panel-default">
                            <center>
                                <br />
                                <!--title-->
                                <h3><b>Orders</b></h3>
                                <!--display the chart-->
                                <div id='orderChartContainer' style='height: 370px; width: 95%;'></div>
                                <br /><br />
                            </center>
                        </div>
                        <!--end of division class 4-->
                    </div>
                    <!--end of division class 3-->
                </div>
                <!--end of division class 2-->
            </div>
        </section>
    </main>
    <!--javascript source-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <!--javascript-->
    <script>
    //when the page is being load
    window.onload = function() {
        //stocks pie chart
        var stocksChart = new CanvasJS.Chart("stocksChartContainer", {
            animationEnabled: true,
            //data to parse
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($stocksChartDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        //message shown if empty
        showDefaultText(stocksChart, "No books");
        //use render to display the specified HTML code inside the specified HTML element
        stocksChart.render();

        //order pie chart
        var orderChart = new CanvasJS.Chart("orderChartContainer", {
            animationEnabled: true,
            //data to parse
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($orderChartDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        //message shown if empty
        showDefaultText(orderChart, "No orders");
        //use render to display the specified HTML code inside the specified HTML element
        orderChart.render();

        //to visualize the data
        function toogleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            //use render to display the specified HTML code inside the specified HTML element
            chart.render();
        }

        //to ensure that a message is displayed in case no data is available for the chart
        function showDefaultText(chart, text) {
            //check if there are any data points
            var isEmpty = !(chart.options.data[0].dataPoints && chart.options.data[0].dataPoints
                .length > 0);

            if (!chart.options.subtitles)
                (chart.options.subtitles = []);

            if (isEmpty)
                //display the message if no data available
                chart.options.subtitles.push({
                    text: text,
                    verticalAlign: 'center',
                });
            else
                (chart.options.subtitles = []);
        }
    }
    </script>
    <!--end of javascript-->
</body>
<!--end of body-->

</html>
<!--end of html-->