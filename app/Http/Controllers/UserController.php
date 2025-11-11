<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // for password hashing

class UserController extends Controller
{
    // LIST all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // SHOW create form
    public function create()
    {
        return view('users.create');
    }

    // STORE new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    // SHOW single user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // SHOW edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // UPDATE user
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validate input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:6',
        'role' => 'required'
    ]);

    // Update fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // Only update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Save user and show success
    $user->save();

    return redirect()->route('users.index')
                     ->with('success', 'User updated successfully.');
}

    // DELETE user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}
