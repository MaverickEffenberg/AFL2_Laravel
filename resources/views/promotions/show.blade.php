@extends('layouts.admin')

@section('title', 'Promotion Detail')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $promotion->title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">Plant: {{ $promotion->plant->name ?? 'N/A' }}</h6>
        <p class="card-text">{{ $promotion->description }}</p>

        <p class="mb-1"><strong>Discount:</strong> {{ $promotion->discount_percentage }}%</p>
        <p class="mb-1"><strong>Start:</strong> {{ optional($promotion->start_at)->format('Y-m-d H:i') }}</p>
        <p class="mb-3"><strong>End:</strong> {{ optional($promotion->end_at)->format('Y-m-d H:i') }}</p>

        @if($promotion->isActive())
            <span class="badge bg-success">Active</span>
        @elseif(optional($promotion->start_at)->isFuture())
            <span class="badge bg-info">Scheduled</span>
        @else
            <span class="badge bg-secondary">Ended</span>
        @endif
    </div>
</div>

<a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning mt-3">Edit</a>
<a href="{{ route('promotions.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
