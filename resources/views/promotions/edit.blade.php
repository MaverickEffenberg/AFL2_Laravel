@extends('layouts.admin')

@section('title', 'Edit Promotion')

@section('content')
<form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Plant</label>
        <select name="plant_id" class="form-control" required>
            @foreach($plants as $plant)
                <option value="{{ $plant->id }}" {{ old('plant_id', $promotion->plant_id) == $plant->id ? 'selected' : '' }}>
                    {{ $plant->name }}
                </option>
            @endforeach
        </select>
        @error('plant_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Discount Percentage</label>
        <input type="number" name="discount_percentage" class="form-control" step="0.01" value="{{ old('discount_percentage', $promotion->discount_percentage) }}" required>
        @error('discount_percentage')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Start At</label>
        <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at', $promotion->start_at->format('Y-m-d\TH:i')) }}" required>
        @error('start_at')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>End At</label>
        <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at', $promotion->end_at->format('Y-m-d\TH:i')) }}" required>
        @error('end_at')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $promotion->title) }}">
        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $promotion->description) }}</textarea>
        @error('description')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button class="btn btn-success">Update</button>
    <a class="btn btn-secondary" href="{{ route('promotions.index') }}">Back</a>
</form>

@endsection