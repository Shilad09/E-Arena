<?php

include 'connection.php';

if(isset($_FILES['pro_img']) && isset($_POST['pro_name'])){
    
    $name = $_POST['pro_name'];
    $price = $_POST['pro_price'];
    $desc = $_POST['pro_desc'];
    $img_name = $_FILES['pro_img']['name'];

    $extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $new_name = rand() . '.' .  $extension;
    $path = '../images/' . $new_name;

    if(move_uploaded_file($_FILES['pro_img']['tmp_name'], $path)){
        $image = 'images/' . $new_name;

        $sql = "INSERT INTO product (name, price, description, image) VALUES ('$name', $price, '$desc', '$image')";

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
    echo 0;
}

mysqli_close($conn);

?>