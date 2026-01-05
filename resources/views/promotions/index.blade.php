@extends('layouts.admin')

@section('title', 'Promotions')

@section('content')
<a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Add Promotion</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plant</th>
                <th>Title</th>
                <th>Discount (%)</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->id }}</td>
                <td>{{ $promotion->plant->name ?? 'N/A' }}</td>
                <td>{{ $promotion->title }}</td>
                <td>{{ $promotion->discount_percentage }}</td>
                <td>{{ optional($promotion->start_at)->format('Y-m-d H:i') }}</td>
                <td>{{ optional($promotion->end_at)->format('Y-m-d H:i') }}</td>
                <td>
                    @if($promotion->isActive())
                        <span class="badge bg-success">Active</span>
                    @elseif(optional($promotion->start_at)->isFuture())
                        <span class="badge bg-info">Scheduled</span>
                    @else
                        <span class="badge bg-secondary">Ended</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-info btn-sm mb-1">View</a>
                    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
