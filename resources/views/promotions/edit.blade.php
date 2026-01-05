@extends('layouts.admin')

@section('title', 'Edit Promotion')

@section('content')
<form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Plant</label>
        <select name="plant_id" class="form-control">
            @foreach($plants as $plant)
                <option value="{{ $plant->id }}" {{ (old('plant_id', $promotion->plant_id) == $plant->id) ? 'selected' : '' }}>
                    {{ $plant->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $promotion->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $promotion->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Discount Percentage</label>
        <input type="number" step="0.01" min="0" max="100" name="discount_percentage" class="form-control" value="{{ old('discount_percentage', $promotion->discount_percentage) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Start At</label>
        <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at', optional($promotion->start_at)->format('Y-m-d\TH:i')) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">End At</label>
        <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at', optional($promotion->end_at)->format('Y-m-d\TH:i')) }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
