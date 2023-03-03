<?php

  $conn = mysqli_connect("localhost","root","","test") or die("Connection failed");

  $limit_per_page = 3;

  $page = "";
  if(isset($_POST["page_no"])){
    $page = $_POST["page_no"];
  }else{
    $page = 1;
  }

  $offset = ($page - 1) * $limit_per_page;

  $sql = "SELECT * FROM employee LIMIT {$offset},{$limit_per_page}";
  $result = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
  $output= "";

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
     

        $sql_total = "SELECT * FROM employee";
        $records = mysqli_query($conn,$sql_total) or die("Query Unsuccessful.");
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<div id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
          $class_name = "active";
        }else{
          $class_name = "";
        }
        $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
        }
        $output .='</div>';

        echo $output;
    mysqli_close($conn);
}
  
  
?>
