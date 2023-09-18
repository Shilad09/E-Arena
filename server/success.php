<?php

    if($_POST['code'] == 'PAYMENT_SUCCESS'){
        
        include "connection.php";
        $value = explode('@', $_COOKIE['user']);
        $uid = $value[0];
        $last_id = $value[1];
        $table_name = 't_' . $uid; 
        $last_id = $last_id;
        $sql = "UPDATE " . $table_name . " SET status = 'success' WHERE id = " . $last_id;
        $var = '';
        if(mysqli_query($conn, $sql)){
            $var = 'Done';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container p-5 ml-10" style="text-align : center; display: flex;
    align-items: center;
    justify-content: center;">
        <div class="card text-bg-success mb-3" style="max-width: 18rem; height: 500px;">
            <div class="card-header">Payment Details</div>
            <div class="card-body">
                <h5 class="card-title"><?= $_POST['code'] ?></h5>
                <p class="card-text"><b>Transaction Id : </b><?= $_POST['transactionId'] ?></p>
                <p class="card-text"><b>Transaction Id : </b><?= $_POST['transactionId'] ?></p>
                <p class="card-text"><b>Amount : </b><?= $_POST['amount']/100 ?></p>
                <p class="card-text"><b>Reference Id : </b><?= $_POST['providerReferenceId'] ?></p>
            </div>
            <a href="../index.html" class="btn btn-danger"><b>Go to home page</b></a>
        </div>
    </div>
</body>
<script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="script.js"></script>

</html>