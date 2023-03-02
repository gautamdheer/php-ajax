<?php

$conn = mysqli_connect("localhost","root","","test") or die("Connection failed");

$sql = "select * from employee";
$result = mysqli_query($conn, $sql) or die("SQL query failed");
$output = "";
if(mysqli_num_rows($result) > 0){
    $output = '<table border="l" width="100%" cellspacing="0" cellpadding="10px">
                    <tr>
                    <th>ID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th width="100px">Edit</th>
                    <th width="100px">Delete</th>
                    </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr>    
                        <td>{$row["id"]}</td>
                        <td>{$row["firstname"]}</td>
                        <td>{$row["lastname"]}</td>
                        <td><button type='button' class='btn btn-secondary edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
                        <td><button type='button' class='btn btn-primary delete-btn' data-id='{$row["id"]}'>Delete</button></td>
                    </tr>";
    }
    echo $output .= '</table>';
    
    mysqli_close($conn);
}
else{
    echo "<h1> No result found </h1>";
}

?>