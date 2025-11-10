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
    <div class="col-sm-6 col-md-4 mb-3 text-center">
      <img src="https://source.unsplash.com/200x200/?person" class="rounded-circle mb-2" alt="Team member">
      <h6>Jermy</h6>
      <p class="text-muted small">Founder & Grower</p>
    </div>
    <div class="col-sm-6 col-md-4 mb-3 text-center">
      <img src="https://source.unsplash.com/200x200/?woman" class="rounded-circle mb-2" alt="Team member">
      <h6>Maverick</h6>
      <p class="text-muted small">Customer Support</p>
    </div>
  </div>
</main>
@endsection
