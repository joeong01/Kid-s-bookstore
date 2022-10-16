<?php  
//action.php
include('dbconnection.php');

$input = filter_input_array(INPUT_POST);

$bookID = mysqli_real_escape_string($con, $input["bookID"]);
$stockNumber = mysqli_real_escape_string($con, $input["stockNumber"]);

$sql = "SELECT * FROM books WHERE bookName = '$bookID'";  
$result = $con->query($sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    while($row = $result->fetch_assoc()) {
        $bookID = $row['bookID'];
    }
  } else {
    echo "0 results";
  }


if($input["action"] === 'edit')
{
 $query = "
 UPDATE stocks 
 SET stockNumber = '$stockNumber'
 WHERE bookID = '$bookID'
 ";

 mysqli_query($con, $query);
}

echo json_encode($input);
//echo json_encode($bookID);