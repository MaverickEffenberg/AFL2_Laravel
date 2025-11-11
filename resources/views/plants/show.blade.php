@extends('layouts.admin')

@section('title', 'Plant Details')

@section('content')
<p><strong>ID:</strong> {{ $plant->id }}</p>
<p><strong>Name:</strong> {{ $plant->name }}</p>
<p><strong>Image:</strong> <img src="{{ asset($plant->image_url) }}" width="120"></p>
<p><strong>Stock:</strong> {{ $plant->stock }}</p>
<p><strong>price:</strong> {{ $plant->price }}</p>

<a href="{{ route('plants.index') }}" class="btn btn-secondary">Back</a>
<a href="{{ route('plants.edit', $plant->id) }}" class="btn btn-warning">Edit</a>
@endsection
