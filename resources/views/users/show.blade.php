@extends('layouts.admin')

@section('title', 'View User')

@section('content')
<p><strong>ID:</strong> {{ $user->id }}</p>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Role:</strong> {{ $user->role }}</p>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
@endsection
