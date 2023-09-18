<?php

use PHPMailer\PHPMailer\PHPMailer;

include "connection.php";

$name = $_POST['uname'];
$phone = $_POST['uphone'];
$email = $_POST['uemail'];
$password = sha1($_POST['upass']);
$otp = rand(111111, 999999);
$admin = 0;

$sql_check = "SELECT email FROM user WHERE email = '$email'";
$check = mysqli_query($conn, $sql_check);

if(mysqli_num_rows($check) > 0){
    echo 'email_exists';
}
else{
    $sql = "INSERT INTO `user`(`name`, `mobile`, `email`, `password`, `otp`, `admin_check`) VALUES ('{$name}', {$phone},'{$email}','{$password}', {$otp}, {$admin})";

    if(mysqli_query($conn, $sql)){
        require "vendor/autoload.php";
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'earena290823@gmail.com';
        $mail->Password = 'ibgtoxhkhpuwqqih';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('earena290823@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'OTP Verification';
        $mail->Body = $otp;
        // $mail->addAttachment();
        if($mail->send()){
            echo mysqli_insert_id($conn);
        }
        else{
            echo "error";
        }
    }
    else{
        echo 'error';
    }
}
