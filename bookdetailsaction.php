<?php  
//action.php
include('dbconnection.php');

$input = filter_input_array(INPUT_POST);

$bookName = mysqli_real_escape_string($con, $input["bookName"]);
$bookAuthor = mysqli_real_escape_string($con, $input["bookAuthor"]);
$bookDescription = mysqli_real_escape_string($con, $input["bookDescription"]);
$bookCategory = mysqli_real_escape_string($con, $input["bookCategory"]);
$publishedDate = mysqli_real_escape_string($con, $input["publishedDate"]);
$price = mysqli_real_escape_string($con, $input["price"]);
$tags = mysqli_real_escape_string($con, $input["tags"]);

$sql = "SELECT * FROM bookcategory WHERE bookCategoryName = '$bookCategory'";  
$result = $con->query($sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    while($row = $result->fetch_assoc()) {
        $bookCID = $row['bookCategoryID'];
    }
  } else {
    echo "0 results";
  }

  $sql = "SELECT tagsID FROM tags WHERE tagsName = '$tags'";
    $result = $con->query($sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
    while($row = $result->fetch_assoc()) {
        $tID = $row['tagsID'];
    }
  } else {
    echo "0 results";
  }

if($input["action"] === 'edit')
{
 $query = "
 UPDATE books 
 SET bookName = '".$bookName."', 
 bookDescription = '".$bookDescription."',
 bookAuthor = '".$bookAuthor."',
 bookCategoryID = '".$bookCID."',
 publishedDate = '".$publishedDate."',
 price = '".$price."', 
 tagsID = '".$tID."' 
 WHERE bookID = '".$input["bookID"]."'
 ";

 mysqli_query($con, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM books 
 WHERE bookID = '".$input["bookID"]."'
 ";
 mysqli_query($con, $query);
}

echo json_encode($input);