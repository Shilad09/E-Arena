<?php

include "connection.php";

if(isset($_POST['uemail']) && isset($_POST['upass'])){

    $email = $_POST['uemail'];
    $pass = sha1($_POST['upass']);

    $sql = "SELECT * from user WHERE email = '{$email}' AND password = '{$pass}'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        session_start();

        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['admin'] = $row['admin_check'];
        echo 1;
    }
    else{
        echo 0;
    }
}
else{
    echo 0;
}


?>