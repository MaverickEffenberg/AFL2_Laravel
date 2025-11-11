@extends('layouts.admin')

@section('title', 'Edit Plant')

@section('content')
<form action="{{ route('plants.update', $plant->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $plant->name) }}">
    </div>

    <div class="mb-3">
        <label>Image URL:</label>
        <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $plant->image_url) }}">
    </div>

    <div class="mb-3">
        <label>Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ old('category_id', $plant->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Stock:</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $plant->stock) }}">
    </div>

    <div class="mb-3">
        <label>Price:</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $plant->price) }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('plants.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
