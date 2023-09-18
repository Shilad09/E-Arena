<?php

include "connection.php";

if(isset($_POST['uotp']) && isset($_POST['last_id'])){
    $id = $_POST['last_id'];
    $sql = "SELECT otp, email FROM user WHERE id = $id";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($_POST['uotp'] == $row['otp']){
            // $table_name = strstr($row['email'], '@', true);
            $table_name = 't_' . $id;

            $sql_create = "CREATE TABLE $table_name (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT(200) NOT NULL,
                status VARCHAR(200) NOT NULL,
                FOREIGN KEY(product_id) REFERENCES product(id)
            )";
            if(mysqli_query($conn, $sql_create)){
                echo true;
            }
            else{
                echo false;
            }
        }
        else{
            echo "otp-not matched";
        }
    }
    else{
        echo "error";
    }
}
else{
    echo 'uotp not set';
}
?>