<?php
include("dbconnection.php");

$link[] = array();
$title[]= array();

$getBook = mysqli_query($con,"SELECT bookID, bookName, bookAuthor FROM books");
$queryRun = mysqli_fetch_array($getBook);

foreach($queryRun as $item){
  array_push($link,$item['bookID']);
  $combine = $item['bookName'].' by '. $item['bookAuthor'];
  array_push($title,$combine);
}

//get the q parameter from URL
$q=$_GET["q"];

if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<count($link);$i++) {
    $temp = $title[$i];
    if (stripos($temp, $q)) {
      if ($hint=="") {
        $hint="<a href='http://localhost/Kid-s-bookstore/book-details.php?id=.$link[$i].'>" . $title[$i]. "</a>";
      } else {
        $hint=$hint."</br><a href='http://localhost/Kid-s-bookstore/book-details.php?id=.$link[$i].'>" . $title[$i]. "</a>";
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