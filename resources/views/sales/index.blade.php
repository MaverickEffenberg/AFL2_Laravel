@extends('layouts.admin')

@section('title', 'Sales Records')

@section('content')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Plant</th>
                <th>User</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->plant->name ?? 'Deleted Plant' }}</td>
                <td>{{ $sale->user->name ?? 'Deleted User' }}</td>
                <td>{{ $sale->created_at ? $sale->created_at->format('Y-m-d H:i') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
