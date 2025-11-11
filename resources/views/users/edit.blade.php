@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>
    <div class="mb-3">
        <label>Password: <small>(leave blank to keep current)</small></label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Role:</label>
        <select name="role" class="form-control">
            <option value="user" {{ old('role', $user->role)=='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
