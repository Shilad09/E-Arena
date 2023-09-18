<?php

include 'connection.php';

$input = $_POST['search_ele'];

$sql = "SELECT  * FROM product WHERE name LIKE '%{$input}%'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='card' id='card-id' data-id='{$row['id']}' style='width: 18rem;'>
        <img src='{$row['image']}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$row['name']}</h5>
          <p class='card-text'><b>Price(₹): {$row['price']}</b></p>
          <p id='product-desc' class='card-text'>{$row['description']}</p>
          <a href='' class='btn btn-primary'>Buy Now</a>
        </div>
      </div>";
    }
}
else{
    echo "No record found";
}

mysqli_close($conn);
?>