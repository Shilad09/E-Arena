<?php

include 'connection.php';

$sql = "SELECT * FROM product";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
  
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='card' id='card-id' data-id='{$row['id']}' style='width: 18rem;'>
        <img src='{$row['image']}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$row['name']}</h5>
          <p class='card-text'><b>Price(₹): ". number_format($row['price']) ."</b></p>
          <p id='product-desc' class='card-text'>{$row['description']}</p>
          <button class='btn btn-primary'>Buy Now</button>
        </div>
      </div>";
    }
}
else{
    echo "No record found";
}

mysqli_close($conn);
?>