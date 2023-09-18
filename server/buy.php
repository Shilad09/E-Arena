<?php

session_start();

if(isset($_SESSION['id'])){

    include "connection.php";
    
    
    
    $id = $_POST['id'];
    
    $sql = "SELECT * FROM product WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);
    $delivery_charge = 50;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='card text-center mb-3 y' style='width: 18rem;'>
            <div class='card-body y'>
              <h5 class='card-title y'>Product name : <b id='product-name'>{$row['name']}</b></h5>
              <p class='card-text y'><b id='product-price-str'>Price : </b><b id='product-price-num'>{$row['price']}</b></p>
              <form id='buyer-form' class='form-control y'>
                    <input class='form-control mt-2 y' type='number' id='buyer-num' name='buyer-num' placeholder='Enter your number'>
                    <input class='form-control mt-3 y' type='text' id='buyer-add' name='buyer-address' placeholder='Enter your address'>
                    <input type='submit' class='btn btn-warning mt-3 mb-2 y' value='Buy now' id='buy-now-btn' data-id='{$row['id']}'>
                    </form>
            </div>
            </div>";
        }
    }
    else{
        echo 'No data found';
    }
    
    mysqli_close($conn);
}
else{
    echo 'not_logged_in';
}


?>