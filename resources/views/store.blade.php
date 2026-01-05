@extends('layouts.layout', ['title' => $title])

@section('content')
<div class="container py-5">
  @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

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
            @if(method_exists($plant, 'currentPromotion') && $plant->currentPromotion())
                <span class="badge bg-danger mb-2">{{ (int)$plant->currentPromotion()->discount_percentage }}% OFF</span>
            @endif
            @if(isset($plant->current_price) && $plant->current_price != $plant->price)
              <p class="mb-1">
                <small class="text-muted"><del>Rp {{ number_format($plant->price,0,',','.') }}</del></small>
                <span class="ml-2 text-danger">Rp {{ number_format($plant->current_price,0,',','.') }}</span>
              </p>
            @else
              <p class="mb-1"><span class="text-muted">Rp {{ number_format($plant->price,0,',','.') }}</span></p>
            @endif
<p class="text-muted">Stock: {{ $plant->stock }}</p>
<div class="d-flex justify-content-between align-items-center">
    <!-- Buy Button -->
    <a href="#"
       class="btn btn-sm {{ $plant->stock > 0 ? 'btn-success' : 'btn-secondary disabled' }}"
       {{ $plant->stock == 0 ? 'aria-disabled=true tabindex=-1' : '' }}>
       Buy
    </a>

    <!-- Add to Wishlist Button -->
    <form action="{{ route('wishlist.store') }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="plant_id" value="{{ $plant->id }}">
        <button type="submit" class="btn btn-sm btn-outline-danger">
            ❤️ Wishlist
        </button>
    </form>
</div>

</a>
</div>
</div>
</div>
@endforeach
</div>
</div>
@endsection