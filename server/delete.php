<?php

include "connection.php";

$id = $_POST['id'];

$sql_img = "SELECT image FROM product WHERE id = $id";
$result = mysqli_query($conn, $sql_img);
$prev_img = mysqli_fetch_assoc($result);
$prev_img_name = pathinfo($prev_img['image'], PATHINFO_BASENAME);
$unset_path = '../images/' . $prev_img_name;
unlink($unset_path);


$sql = "DELETE FROM product WHERE id = {$id}";

if(mysqli_query($conn, $sql)){
    echo true;
}
else{
    echo false;
}


?>