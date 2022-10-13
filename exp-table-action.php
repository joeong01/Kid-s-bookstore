<?php  
//action.php
include('dbconnection.php');

$input = filter_input_array(INPUT_POST);

$identifiers = $input["identifiers"];
$id_array = preg_split("/;/",$identifiers);
//id_array[0] = id
//id_array[1] = name

$name = mysqli_real_escape_string($con, $input["bookCategoryName"]);

if($input["action"] === 'edit')
{
 $query2 = "
 UPDATE bookcategory 
 SET bookCategoryName = '".$name."'
 WHERE bookCategoryID = '".$id_array[0]."'
 ";

 mysqli_query($con, $query2);

}

if($input["action"] === 'delete')
{
 $query1 = "
 DELETE FROM books 
 WHERE bookCategoryID = '".$id_array[0]."'
 ";
 
 mysqli_query($con, $query1);

 $query2 = "
 DELETE FROM bookcategory 
 WHERE bookCategoryID = '".$id_array[0]."'
 ";
 mysqli_query($con, $query2);
}

echo json_encode($input);

?>