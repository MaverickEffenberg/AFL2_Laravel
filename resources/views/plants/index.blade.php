@extends('layouts.admin')

@section('title', 'Plants')

@section('content')
<a href="{{ route('plants.create') }}" class="btn btn-primary mb-3">Add Plant</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Family</th>
            <th>Image</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($plants as $plant)
        <tr>
            <td>{{ $plant->id }}</td>
            <td>{{ $plant->name }}</td>
            
            <td>{{ $plant->category->name }}</td>
            <td><img src="{{ $plant->image_url }}" alt="{{ $plant->name }}" width="80"></td>
            <td>{{ $plant->stock }}</td>
            <td>{{ $plant->price }}</td>
            <td>
                <a href="{{ route('plants.show', $plant->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('plants.edit', $plant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('plants.destroy', $plant->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
