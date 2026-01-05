@extends('layouts.admin')

@section('title', 'Add Promotion')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('promotions.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Plant</label>
        <select name="plant_id" class="form-control" required>
            @foreach($plants as $plant)
                <option value="{{ $plant->id }}" {{ old('plant_id') == $plant->id ? 'selected' : '' }}>{{ $plant->name }}</option>
            @endforeach
        </select>
        @error('plant_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Discount Percentage</label>
        <input type="number" name="discount_percentage" class="form-control" step="0.01" required value="{{ old('discount_percentage') }}">
        @error('discount_percentage')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Start At</label>
        <input type="datetime-local" name="start_at" class="form-control" required value="{{ old('start_at') ? \Carbon\Carbon::parse(old('start_at'))->format('Y-m-d\TH:i') : '' }}">
        @error('start_at')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>End At</label>
        <input type="datetime-local" name="end_at" class="form-control" required value="{{ old('end_at') ? \Carbon\Carbon::parse(old('end_at'))->format('Y-m-d\TH:i') : '' }}">
        @error('end_at')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a class="btn btn-secondary" href="{{ route('promotions.index') }}">Back</a>
</form>
</form>

@endsection