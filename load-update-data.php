<?php
$studID = $_POST['id'];


$conn = mysqli_connect("localhost","root","","test") or die("Connection failed");

$sql = "select * from employee where id='{$studID}'";
$result = mysqli_query($conn, $sql) or die("SQL query failed");
$output = "";
if(mysqli_num_rows($result) > 0){
     
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<div class='edit-form'>
        <form method='POST' id='eForm' >
        <div class='form-group'>
            <label> Firstname </label>
            <input type='text'  hidden id='edit-id' value='{$row["id"]}'>
            <input type='text' name='firstname' id='edit-fname'  value='{$row["firstname"]}'>

        </div>
        <div class='form-group'>
            <label> Lastname </label>
            <input type='text' name='lastname' id='edit-lname'  value='{$row["lastname"]}'>
        </div>
        <div class='form-group'>
             <input class='btn btn-primary editBtn' id='editBtn' type='submit' value='Save' name='save'>
        </div>

        </form>

    </div>";
    }
  
   

    mysqli_close($conn);

    echo $output;
}
else{
    echo "<h1> No result found </h1>";
}




?>