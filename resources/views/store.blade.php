@extends('layouts.layout', ['title' => $title])

@section('content')
<div class="container py-5">
  <h2 class="mb-4">Store</h2>

  <form method="GET" action="{{ url('/store') }}" class="mb-4">
      <input type="text" name="search" placeholder="Search plants..." value="{{ $search ?? '' }}" class="form-control" />
      <button type="submit" class="btn btn-primary mt-2">Search</button>
  </form>

  <div class="row">
      @foreach($plants as $plant)
      <div class="col-md-4 mb-4">
        <div class="card product-card">
          <img src="{{ $plant->image_url }}" class="card-img-top" alt="{{ $plant->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $plant->name }}</h5>
            <p class="text-muted">Price: IDR{{ $plant->price }}</p>
            <p class="text-muted">Stock: {{ $plant->stock }}</p>
            <a href="#"
               class="btn btn-sm {{ $plant->stock > 0 ? 'btn-success' : 'btn-secondary disabled' }}"
               {{ $plant->stock == 0 ? 'aria-disabled=true tabindex=-1' : '' }}>
                Buy
            </a>
          </div>
        </div>
      </div>
      @endforeach
  </div>
</div>
@endsection
