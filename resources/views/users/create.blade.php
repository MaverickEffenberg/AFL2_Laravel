@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label>Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Role:</label>
        <select name="role" class="form-control">
            <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <!-- FIX: disable double submit -->
    <button type="submit" class="btn btn-success"
            onclick="this.disabled=true; this.form.submit();">
        Save
    </button>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
