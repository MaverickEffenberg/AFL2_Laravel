@extends('layouts.layout', ['title' => $title])

@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="container mt-4">
        {{-- Flash messages --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="mb-3">My Profile</h2>

        {{-- BASIC INFO (READ-ONLY) --}}
        <div class="card mb-4">
            <div class="card-header">
                Current Information
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                
                @if (!empty($user->phone))
                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                @endif
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header">
                Edit Profile
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $error }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $error }}</div>
                        @enderror
                    </div>

                    
                    @if (Schema::hasColumn('users', 'phone'))
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}"
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            required
                        >
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-warning">
                        Update Password
                    </button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Add/Remove/Change Address
            </div>
        <div>
            <button type="submit" class="btn btn-primary">
                        Add Address
                    </button>
        </div>
               
                
        </div>

        <div class="card mb-4">
            <div class="card-header text-danger">
                Delete Account
            </div>
            <div class="card-body">
                <p class="text-danger">
                    This action cannot be undone. All data related to your account may be deleted.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}"
                      onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete My Account
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
