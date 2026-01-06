<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Plant;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', \App\Http\Middleware\CheckIfAdmin::class])
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $promotions = Promotion::with('plant')->get();
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
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Normalize dates with Carbon; accept datetime-local or ISO strings
        $data['start_at'] = Carbon::parse($request->input('start_at'));
        $data['end_at'] = Carbon::parse($request->input('end_at'));

        Promotion::create($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion created.');
    }

    public function show($id)
    {
        $promotion = Promotion::with('plant')->findOrFail($id);
        return view('promotions.show', compact('promotion'));
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $plants = Plant::all();
        return view('promotions.edit', compact('promotion', 'plants'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $data = $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['start_at'] = Carbon::parse($request->input('start_at'));
        $data['end_at'] = Carbon::parse($request->input('end_at'));

        $promotion->update($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion updated.');
    }

    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotion deleted.');
    }
}