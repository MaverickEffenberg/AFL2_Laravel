<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Show all addresses for admin or user.
     */
    public function index()
    {
        // Admin sees all addresses, user sees their own
        $user = Auth::user();

        if ($user->role === 'admin') {
    $addresses = Address::with('user')->get(); // <-- this line is key
} else {
    $addresses = Address::with('user')->where('user_id', $user->id)->get();
}


        return view('addresses.index', compact('addresses'));
    }
}
