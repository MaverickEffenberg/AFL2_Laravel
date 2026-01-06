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
                @if(method_exists($plant, 'currentPromotion') && $plant->currentPromotion())
                    <span class="badge badge-danger mb-2">{{ (int)$plant->currentPromotion()->discount_percentage }}% OFF</span>
                @endif
                <p class="card-text">Iconic and fascinating — great for beginners.</p>
                <p class="mb-2">
                  @if(isset($plant->current_price) && $plant->current_price != $plant->price)
                    <small class="text-muted"><del>Rp {{ number_format($plant->price,0,',','.') }}</del></small>
                    <span class="ml-2 text-danger">Rp {{ number_format($plant->current_price,0,',','.') }}</span>
                  @else
                    <span class="text-muted">Rp {{ number_format($plant->price,0,',','.') }}</span>
                  @endif
                </p>
                <a href="store" class="btn btn-sm btn-success">Buy</a>
              </div>
            </div>
          </div>

@endforeach

        </div>
      </div>
    </section>
@endsection
