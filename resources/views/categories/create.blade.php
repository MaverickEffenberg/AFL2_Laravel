@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label>Image URL:</label>
        <input type="text" name="image_url" class="form-control" value="{{ old('image_url') }}">
    </div>
    <div class="mb-3">
        <label>Guide Text:</label>
        <textarea name="guide_text" class="form-control">{{ old('guide_text') }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
