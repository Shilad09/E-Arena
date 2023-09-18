<?php

include "connection.php";

$id = $_POST['id'];

$sql = "SELECT * FROM product WHERE id = {$id}";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo  "<img class='mt-4 ml-2' src='{$row['image']}' alt='' height = '220' width='200'>
        <form id='one-details-form' class='form-control mt-4 mb-4 ml-5'>
        <input type='text' class='form-control mb-4' name='pro_pro_id' value='{$row['id']}' hidden>
        <input type='text' class='form-control mb-4' name='pro_pro_name' value='{$row['name']}'>
        <input type='number' class='form-control mb-4' name='pro_pro_price' value='{$row['price']}'>
        <input type='text' class='form-control mb-4' name='pro_pro_desc' value='{$row['description']}'>
        <input type='file' id='pro_pro_img' class='form-control mb-4' name='pro_pro_img' accept='image/*'>
        <input type='submit' class='btn btn-success' id='one-update' value='Update'>
        </form>";
    }
}
else{
    echo "No record found";
}

mysqli_close($conn);


?>