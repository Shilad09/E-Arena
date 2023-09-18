<?php

session_start();

if(isset($_SESSION['id'])){
    include "connection.php";

    $sql_id = "SELECT id FROM user WHERE email = '{$_POST['user-email']}'"; 
    $result_id = mysqli_query($conn, $sql_id);
    if(mysqli_num_rows($result_id) > 0){

        $user_id = mysqli_fetch_assoc($result_id);
    
        $table_name = 't_' . $user_id['id'];
        $sql = "SELECT * FROM " . $table_name . " INNER JOIN product ON " . $table_name . ".product_id = product.id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $output = "<table class='table table-bordered table-striped'>
            <tr align='center'>
            <th>Product image</th>
            <th>Product name</th>
            <th>Product price</th>
            <th>Payment status</th>
            </tr>
            ";
            while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr align='center'>
                <td><img src='{$row['image']}' alt='' height='300'></td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['status']}</td>
                </tr>";
            }
            $output .= '</table>';
    
            echo $output;
        }
        else{
            echo '<b>No record found</b>';
        }
    }
    else{
        echo "<b>Email not exists</b>";
    }
    mysqli_close($conn);
}
else{
    echo false;
}



?>