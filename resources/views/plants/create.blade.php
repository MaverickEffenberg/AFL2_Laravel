@extends('layouts.admin')

@section('title', 'Add Plant')

@section('content')
<form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label>Upload Image:</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label>Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Stock:</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
    </div>

    <div class="mb-3">
        <label>Price:</label>
        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('plants.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
