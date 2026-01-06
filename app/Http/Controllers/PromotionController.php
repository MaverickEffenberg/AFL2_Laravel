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
        $data = $request->validate(
            [
                'plant_id' => 'required|exists:plants,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'discount_percentage' => 'required|numeric|min:0|max:100',
                'start_at' => 'required|date',
                'end_at' => 'required|date|after_or_equal:start_at',
            ],
            [
                'title.required' => 'Title is required.',
                'description.required' => 'Description is required.',
            ]
        );

            $data['start_at'] = Carbon::parse($request->start_at)->subHours(7);
            $data['end_at']   = Carbon::parse($request->end_at)->subHours(7);

        Promotion::create($data);

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Promotion created successfully.');
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

        $data = $request->validate(
            [
                'plant_id' => 'required|exists:plants,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'discount_percentage' => 'required|numeric|min:0|max:100',
                'start_at' => 'required|date',
                'end_at' => 'required|date|after_or_equal:start_at',
            ]
        );

        $data['start_at'] = Carbon::parse($request->start_at);
        $data['end_at'] = Carbon::parse($request->end_at);

        $promotion->update($data);

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::findOrFail($id)->delete();

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }
}
