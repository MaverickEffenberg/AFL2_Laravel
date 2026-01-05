<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('plant')->orderByDesc('start_at')->get();
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        $plants = Plant::all();
        return view('promotions.create', compact('plants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        Promotion::create($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion created successfully.');
    }

    public function show(Promotion $promotion)
    {
        $promotion->load('plant');
        return view('promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        $plants = Plant::all();
        return view('promotions.edit', compact('promotion', 'plants'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        $promotion->update($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
