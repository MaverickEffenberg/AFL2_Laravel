@extends('layouts.layout', ['title' => $title])

@section('content')
<main class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h2 class="brand">Our Story</h2>
      <p>My Carnivlora began as a hobby among friends fascinated by carnivorous plants. Today, we provide healthy, hand-raised plants and expert care advice to enthusiasts worldwide.</p>
      <h5>Our Mission</h5>
      <p>To inspire curiosity and promote sustainable cultivation of carnivorous species.</p>
    </div>
    <div class="col-md-6">
      <img src="{{ asset('images/my_carnivlora.jpg') }}" 
      alt="Shop" 
      class="img-fluid rounded-circle shadow-sm" 
      style="width: 350px; height: 350px; object-fit: cover;">
    </div>
  </div>
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
  <hr>
  <h5>Meet the Team</h5>
  <div class="row">
    <div class="rounded-circle mb-2 mx-auto" style="width:300px;">
      <img src="{{ asset('images/Maverick.jpeg') }}" 
          class="rounded-circle img-fluid mb-2"
          style="aspect-ratio: 1/1; object-fit: cover;" 
          alt="Team member">
      <h6>Maverick</h6>
      <p class="text-muted small">Founder & Grower</p>
    </div>
    <div class="rounded-circle mb-2 mx-auto" style="width:300px;">
      <img src="{{ asset('images/Jermy.jpeg') }}" 
          class="rounded-circle img-fluid mb-2"
          style="aspect-ratio: 1/1; object-fit: cover;" 
          alt="Team member">
      <h6>Jermy</h6>
      <p class="text-muted small">Customer Support</p>
    </div>
  </div>
</main>
@endsection
