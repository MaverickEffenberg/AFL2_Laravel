@extends('layouts.layout', ['title' => $title])

@section('content')
<div class="container py-5">
  <h2 class="mb-4">Store</h2>

<form method="GET" action="{{ url('/store') }}" class="mb-4">
    <div class="row">
        <div class="col-12 col-md-8 mb-2 mb-md-0">
            <input type="text" name="search" id="search" class="form-control" 
                   placeholder="Search for plants..." 
                   value="{{ $search ?? '' }}">
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-success btn-sm w-100 w-md-auto">Search</button>
        </div>
    </div>
</form>


  @if($plants->isEmpty() && isset($search))
      <p>No results found for “<strong>{{ $search }}</strong>”. Check the spelling or use a different word or phrase.</p>
  @endif

  <div class="row">
      @foreach($plants as $plant)
      <div class="col-md-4 mb-4">
        <div class="card product-card">
          <img src="{{ $plant->image_url }}" class="card-img-top" alt="{{ $plant->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $plant->name }}</h5>
            <p class="text-muted">Rp {{ $plant->price }}</p>
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
