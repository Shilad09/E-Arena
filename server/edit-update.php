<?php

include "connection.php";

$id = $_POST['pro_pro_id'];
$name = $_POST['pro_pro_name'];
$price = $_POST['pro_pro_price'];
$desc = $_POST['pro_pro_desc'];

if($_FILES['pro_pro_img']['name'] != NULL){

    $sql_img = "SELECT image FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql_img);
    $prev_img = mysqli_fetch_assoc($result);
    $prev_img_name = pathinfo($prev_img['image'], PATHINFO_BASENAME);
    $unset_path = '../images/' . $prev_img_name;
    unlink($unset_path);

    $img_name = $_FILES['pro_pro_img']['name'];
    $extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $new_img_name = rand() . '.' . $extension;
    $path = '../images/' . $new_img_name;

    if(move_uploaded_file($_FILES['pro_pro_img']['tmp_name'], $path)){
        $image = 'images/' . $new_img_name;

        $sql = "UPDATE product SET name = '$name', price = $price, description = '$desc', image = '$image' WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        echo -1;
    }
}
else{

    $sql = "UPDATE product SET name = '$name', price = $price, description = '$desc' WHERE id = $id";    

    if(mysqli_query($conn, $sql)){
        echo 1;
    }
    else{
        echo 0;
    }
}

mysqli_close($conn);
?>