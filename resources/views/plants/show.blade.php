@extends('layouts.admin')

@section('title', 'Plant Details')

@section('content')
<p><strong>ID:</strong> {{ $plant->id }}</p>
<p><strong>Name:</strong> {{ $plant->name }}</p>
<p><strong>Image:</strong> <img src="{{ asset($plant->image_url) }}" width="120"></p>
<p><strong>Stock:</strong> {{ $plant->stock }}</p>
<p><strong>price:</strong>
	@if(method_exists($plant, 'currentPromotion') && $plant->currentPromotion())
		<small class="text-muted"><del>Rp {{ number_format($plant->price,0,',','.') }}</del></small>
		<span class="text-danger">Rp {{ number_format($plant->current_price,0,',','.') }}</span>
	@else
		Rp {{ number_format($plant->price,0,',','.') }}
	@endif
</p>

<a href="{{ route('plants.index') }}" class="btn btn-secondary">Back</a>
<a href="{{ route('plants.edit', $plant->id) }}" class="btn btn-warning">Edit</a>
@endsection
