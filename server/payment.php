<?php

$buyer_num = $_POST['buyer_num'];
$buyer_address = $_POST['buyer_add'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_id = $_POST['prod_id'];


$data = array(
    "merchantId" => "MERCHANTUAT", 
    "merchantTransactionId" => "MT7850590068188104", 
    "merchantUserId" => "MUID123", 
    "amount" => $product_price * 100, 
    "redirectUrl" => "https://earena29.000webhostapp.com/server/success.php",
    "redirectMode" => "POST", 
    "callbackUrl" => "https://earena29.000webhostapp.com/server/success.php",
    "mobileNumber" => "9999999999", 
    "paymentInstrument" => array(
          "type" => "PAY_PAGE"
        )
    );

$encode = base64_encode(json_encode($data));

$saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
$saltIndex = 1;

$str = $encode . '/pg/v1/pay' . $saltKey;
$sha256 = hash('sha256', $str);

$finalXHeader = $sha256 . '###' . $saltIndex;


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'request' => $encode
  ]),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "X-VERIFY: " . $finalXHeader,
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  session_start();
  include "connection.php";
  $table_name = 't_' . $_SESSION['id'];
  $sql = "INSERT INTO " . $table_name . "(product_id, status) VALUES (" . $product_id . ", 'pending')";

  if(mysqli_query($conn, $sql)){
    // Define your cookie parameters
    $cookieName = "user"; // Replace with your desired cookie name
    $cookieValue = $_SESSION['id'] . '@' . mysqli_insert_id($conn); // Replace with the value you want to store
    $expirationTime = time() + 3600; // Expires in 1 hour (you can adjust this as needed)
    $cookiePath = "/"; // Cookie is available across the entire domain
    //$cookieDomain = "example.com"; // Replace with your domain (optional)
    setcookie($cookieName, $cookieValue, $expirationTime, $cookiePath);
    $responseData = json_decode($response, true);
    $responseUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
    echo $responseUrl;
  }
  else{
    echo false;
  }
}

?>