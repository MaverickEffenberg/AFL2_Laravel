@extends('layouts.layout', ['title' => $title])

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Carnivorous Plant Care Guide</h2>

    <!-- Dropdown form -->
    <form method="GET" action="{{ url('/guide') }}" class="mb-4">
        <label for="plant">Select a Plant:</label>
        <select name="plant" id="plant" class="form-select" onchange="this.form.submit()">
            <option value="">-- All Plants --</option>
            @foreach($plants as $p)
                <option value="{{ $p->name }}" {{ ($selectedPlant ?? '') == $p->name ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Display guide -->
    @foreach($plants as $plant)
        @if(empty($selectedPlant) || $selectedPlant == $plant->name)
            <div class="mb-4 p-3 border rounded">
                <h4>{{ $plant->name }}</h4>
                <p>{{ $plant->guide }}</p>
            </div>
        @endif
    @endforeach
</div>
@endsection
