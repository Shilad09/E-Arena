<?php

include "connection.php";

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $output = "<table class='table table-bordered table-striped'>
    <tr align='center'>
    <th>Product name</th>
    <th>Product Price</th>
    <th>Product Description</th>
    <th>Product image</th>
    <th>Update</th>
    <th>Delete</th>
    </tr>
    ";
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr align='center'>
        <td>{$row['name']}</td>
        <td>".number_format($row['price'])."</td>
        <td>{$row['description']}</td>
        <td><img src='{$row['image']}' alt='' height=320></td>
        <td><button class='btn btn-warning' id='edit-btn' data-id='{$row['id']}'>Edit</button></td>
        <td><button class='btn btn-danger' id='delete-btn' data-id='{$row['id']}'>Delete</button></td>
        </tr>";
    }
    $output .= "</table>";

    echo $output;
}
else{
    echo "No records";
}

mysqli_close($conn);

?>