@extends('layouts.admin')

@section('title', 'Promotions')

@section('content')
<a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Add Promotion</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th><th>Plant</th><th>Discount %</th><th>Start</th><th>End</th><th>Active</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($promotions as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->plant->name ?? '—' }}</td>
                <td>{{ $p->discount_percentage }}</td>
                <td>{{ $p->start_at }}</td>
                <td>{{ $p->end_at }}</td>
                <td>{{ $p->isActive() ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('promotions.show', $p->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('promotions.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('promotions.destroy', $p->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection