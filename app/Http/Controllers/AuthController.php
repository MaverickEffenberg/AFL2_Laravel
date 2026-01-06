<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Promotion;

class AuthController extends Controller
{
        public function signupStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Account created! Please log in.');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Login user
            Auth::login($user);

            // Flash promotion popup for non-admin users
            if ($user->role !== 'admin') {
                $promo = Promotion::with('plant')->active()->orderByDesc('discount_percentage')->first();
                if ($promo) {
                    $request->session()->flash('promotion_popup', [
                        'title' => $promo->title ?? ($promo->plant->name . ' Promotion'),
                        'description' => $promo->description ?? ($promo->discount_percentage . "% off " . ($promo->plant->name ?? 'selected items')),
                    ]);
                }
            }

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin');
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}