@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')
<p><strong>ID:</strong> {{ $category->id }}</p>
<p><strong>Name:</strong> {{ $category->name }}</p>
<p><strong>Image:</strong> <img src="{{ asset($category->image_url) }}" width="120"></p>
<p><strong>Guide Text:</strong> {{ $category->guide_text }}</p>

<a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
@endsection
