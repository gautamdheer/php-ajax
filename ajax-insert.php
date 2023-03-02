<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$conn = mysqli_connect('localhost', 'root','','test') or die("Database not connected");

$sql = "INSERT INTO employee(firstname,lastname) VALUES('{$firstname}','{$lastname}')";

//$result = mysqli_query($conn, $sql) or die("SQL problem");

if(mysqli_query($conn, $sql)){
    echo 1;
}
else{
    echo 0;
}