
<?php

$stuID = $_POST["id"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];


$conn = mysqli_connect("localhost","root","","test") or die("Connection failed");

$sql = "UPDATE employee SET firstname = '{$fname}', lastname = '{$lname}' WHERE id = '{$stuID}'";
//$sql = "select * from employee where id='{$emp_id}'";
// $result = mysqli_query($conn, $sql) or die("SQL query failed");

 if(mysqli_query($conn, $sql)){
    echo "Data Successfully Updated";
 }
 else{
    echo "there is issue in updating the data";
 }

?>