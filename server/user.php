<?php

include "connection.php";
session_start();

if(isset($_SESSION['id'])){
    $table_name = 't_' . $_SESSION['id'];
    $sql = "SELECT * FROM " . $table_name . " INNER JOIN product ON " . $table_name . ".product_id = product.id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $output = "<table class='table table-bordered table-striped'>
        <tr>
        <th>Product Image</th>
        <th>Product name</th>
        <th>Product price</th>
        <th>Payment status</th>
        </tr>
        ";
        
        while($row = mysqli_fetch_assoc($result)){
            
            $output .= "<tr>
            <td><img src='{$row['image']}' alt='' height='300' width='300'></td>
            <td>{$row['name']}</td>
            <td>{$row['price']}</td>
            <td>{$row['status']}</td>
            </tr>";
        }
        
        $output .= "</table>";
        echo $output;
    }
    else{
        echo "<tr><td colspan = '3'>No data found</td></tr>";

    }
}

?>