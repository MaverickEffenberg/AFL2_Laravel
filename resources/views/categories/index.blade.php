@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Guide Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><img src="{{ $category->image_url }}" alt="{{ $category->name }}" width="80"></td>
                <td>{{ $category->guide_text }}</td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm mb-1">View</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
