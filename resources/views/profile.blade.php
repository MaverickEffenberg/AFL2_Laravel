@extends('layouts.layout', ['title' => $title])

@section('content')

<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-sandbox.collaborator.komerce.id/tariff/api/v1/destination/search?keyword=53131',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: s72IdQd181be83daff5b3b131XWfLbkI'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

echo "";
// Hardcoded test values
$origin      = 577;
$destination = 388;
$weight      = 1500;    // grams
$courier     = "jne";
$price       = "lowest";


$postFields = http_build_query([
    'origin'      => $origin,
    'destination' => $destination,
    'weight'      => $weight,
    'courier'     => $courier,
    'price'       => $price,
]);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $postFields,
  CURLOPT_HTTPHEADER => array(
    'key: s72IdQd181be83daff5b3b131XWfLbkI',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
 
@endsection
