<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index(Request $request)
    {
        $plants = Guide::all();
        $selectedPlant = $request->input('plant', '');

        return view('guide', [
            'title' => 'Guide',
            'plants' => $plants,
            'selectedPlant' => $selectedPlant
        ]);
    }
}
