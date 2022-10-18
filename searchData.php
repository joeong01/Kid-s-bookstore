<?php
include("dbconnection.php");

$link[] = array();
$title[]= array();
$hint = "";
$getBook = mysqli_query($con,"SELECT bookID, bookName, bookAuthor FROM books");

//get the q parameter from URL
$temp = "";
$q=$_GET["q"];

if (strlen($q)>0) {
  $hint="";
  foreach($getBook as $item){
    if (stripos($item['bookName'], $q) || stripos($item['bookAuthor'], $q)) {
      if ($hint=="") {
        $hint="<a href='http://localhost/Kid-s-bookstore/book-details.php?id=$item[bookID]'>" . $item['bookName'] . " by " . $item['bookAuthor'] ."</a>";
      } else {
        $hint=$hint."</br></br><a href='http://localhost/Kid-s-bookstore/book-details.php?id=$item[bookID]'>" . $item['bookName'] . " by " . $item['bookAuthor'] ."</a>";
      }
    }
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
