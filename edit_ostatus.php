<?php  
//action.php
include('dbconnection.php');

$input = filter_input_array(INPUT_POST);

$orderID = mysqli_real_escape_string($con, $input["orderID"]);
$status = mysqli_real_escape_string($con, $input["status"]);

$sql = "SELECT * FROM `orderstatus` WHERE `status` = '$status'";  
$result = $con->query($sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    while($row = $result->fetch_assoc()) {
        $statusID = $row['statusID'];
    }
  } else {
    echo "0 results";
  }


if($input["action"] === 'edit')
{
 $query = "
 UPDATE `order`
 SET statusID = '$statusID'
 WHERE orderID = '$orderID'
 ";

 mysqli_query($con, $query);
}

echo json_encode($input);