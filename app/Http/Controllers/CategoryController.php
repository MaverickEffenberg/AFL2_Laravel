<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $selectedFamily = $request->input('family');

        $plants = $selectedFamily
            ? Plant::where('family', $selectedFamily)->get()
            : Plant::all();

        return view('store', [
            'title' => 'Store',
            'plants' => $plants,
            'categories' => $categories,
            'selectedFamily' => $selectedFamily
        ]);
    }
}
