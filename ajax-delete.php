<?php

$employeeID = $_POST["id"];

$conn = mysqli_connect('localhost', 'root','','test') or die("Database not connected");

$sql = "DELETE from employee where id={$employeeID}";

//$result = mysqli_query($conn, $sql) or die("SQL problem");

if(mysqli_query($conn, $sql)){
    echo 1;
}
else{
    echo 0;
}



?>