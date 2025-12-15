@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container py-4">
    <h2>Edit Category</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL:</label>
            <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $category->image_url) }}">
        </div>

        <div class="mb-3">
            <label for="guide_text" class="form-label">Guide Text:</label>
            <textarea name="guide_text" id="guide_text" class="form-control" rows="4">{{ old('guide_text', $category->guide_text) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection