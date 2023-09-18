<?php

include 'connection.php';

$id = $_POST['id'];

$sql = "SELECT * FROM product WHERE id = {$id}";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='card mb-3 x' style='max-width: 540px;' id='fetch-box-result'>
        <div class='row g-0 x'>
          <div class='col-md-4 x'>
            <img src='{$row['image']}' class='img-fluid rounded-start x' alt=''>
          </div>
          <div class='col-md-8 x'>
            <div class='card-body x'>
              <h5 class='card-title x'>{$row['name']}</h5>
              <p class='card-text x'><b>Price(₹): ". number_format($row['price']) ."</b></p>
              <p class='card-text x'>{$row['description']}</p>
              <button data-id='{$row['id']}' id='buy-btn' class='btn btn-success'>Buy now</button>
            </div>
          </div>
        </div>
      </div>";
    }
}
else{
    echo 'No record found';
}

mysqli_close($conn);



?>