@extends('layouts.layout', ['login' => $title])

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Login</h2>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email') }}"
            >
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control"
            >
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <p class="mt-3">
            Don't have an account?
            <a href="{{ url('/signup') }}">Sign up here</a>
        </p>
    </form>
</div>
@endsection
