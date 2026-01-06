<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the logged-in user's profile page.
     */
    public function edit()
    {
        return view('profile', [
            'title' => 'My Profile',
        ]);
    }

    /**
     * Update the logged-in user's profile data (name, email, etc.).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // add more rules if you have more columns, e.g. phone:
            // 'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        



        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the logged-in user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($validated['password']);


        return redirect()
            ->route('profile.edit')
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Delete the logged-in user's account.
     */
    public function destroy(Request $request)
{
    $user = Auth::user();

    Auth::logout();



    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')
        ->with('success', 'Your account has been deleted.');
}
}
