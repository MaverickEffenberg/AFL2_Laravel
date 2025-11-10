@extends('layouts.layout', ['title' => $title])

@section('content')
<div class="container py-5">
  <h2 class="mb-4">Store</h2>

  <form method="GET" action="{{ url('/store') }}">
        <label for="family">Select Plant Family:</label>
        <select name="family" id="family" onchange="this.form.submit()">
            <option value="">-- All Families --</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}" {{ ($selectedFamily ?? '') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
  </form>

  <div class="row">
      @foreach($plants as $plant)
      <div class="col-md-4 mb-4">
        <div class="card product-card">
          <img src="{{ $plant->image_url }}" class="card-img-top" alt="{{ $plant->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $plant->name }}</h5>
            <p class="text-muted">Price: IDR{{ $plant->price }}</p>
            <a href="#" class="btn btn-success btn-sm">Add to Cart</a>
          </div>
        </div>
      </div>
      @endforeach
  </div>
</div>
@endsection
