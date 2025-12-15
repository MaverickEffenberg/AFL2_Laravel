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
