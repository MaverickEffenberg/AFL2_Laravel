<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show user's wishlist
    public function index()
    {
        $wishlist = Wishlist::with('plant')
            ->where('user_id', Auth::id())
            ->get();

        return view('wishlist.index', compact('wishlist'));
    }

    // Add plant to wishlist
    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id'
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'plant_id' => $request->plant_id
        ]);

        return redirect()->back()->with('success', 'Plant added to wishlist!');
    }

    // Remove plant from wishlist
    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('plant_id', $id)
            ->firstOrFail();

        $wishlist->delete();

        return redirect()->back()->with('success', 'Plant removed from wishlist.');
    }
}
