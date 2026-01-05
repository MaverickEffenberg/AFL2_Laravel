@extends('layouts.admin')

@section('title', 'Promotion Details')

@section('content')
<p><strong>ID:</strong> {{ $promotion->id }}</p>
<p><strong>Plant:</strong> {{ $promotion->plant->name ?? '—' }}</p>
<p><strong>Discount:</strong> {{ $promotion->discount_percentage }}%</p>
<p><strong>Start:</strong> {{ $promotion->start_at }}</p>
<p><strong>End:</strong> {{ $promotion->end_at }}</p>
<p><strong>Active:</strong> {{ $promotion->isActive() ? 'Yes' : 'No' }}</p>
<p><strong>Title:</strong> {{ $promotion->title }}</p>
<p><strong>Description:</strong> {{ $promotion->description }}</p>

<a href="{{ route('promotions.index') }}" class="btn btn-secondary">Back</a>
<a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning">Edit</a>
@endsection