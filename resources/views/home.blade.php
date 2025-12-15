@extends('layouts.layout')


  @section('content')
    <header class="hero py-5 text-center">
      <div class="container">
        <h1 class="display-4 brand">Welcome to My Carnivlora</h1>
        <p class="lead">Rare and common carnivorous plants — for curious beginners to passionate collectors.</p>
        <a href="{{ url('/store') }}" class="btn btn-success btn-lg mr-2">Shop Plants</a>
        <a href="{{ url('/guide') }}" class="btn btn-outline-secondary btn-lg">Care Guide</a>
      </div>
    </header>

    <section class="py-5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Featured Plants</h2>
          <a href="{{ url('/store') }}" class="small">View all →</a>
        </div>
        <div class="row">

          

          @foreach ($plants->take(3) as $plant)
          <div class="col-md-4 mb-4">
            <div class="card product-card">
              <img src="{{asset ($plant->image_url)   }}" class="card-img-top" alt="{{ $plant->name }}">
              <div class="card-body">
                <h5 class="card-title">{{ $plant->name }}</h5>
                <p class="card-text">Iconic and fascinating — great for beginners.</p>
                <a href="store" class="btn btn-sm btn-success">Buy</a>
              </div>
            </div>
          </div>
    
@endforeach

        </div>
      </div>
    </section>
@endsection

   
