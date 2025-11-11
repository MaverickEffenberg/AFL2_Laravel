<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Category;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    // List all plants
    public function index()
    {
        $plants = Plant::with('category')->get(); // eager load category
        $categories = Category::all();
        return view('plants.index', compact('plants', 'categories'));
    }

    // Show form to create new plant
    public function create()
    {
        $categories = Category::all();
        return view('plants.create', compact('categories'));
    }

    // Store new plant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Plant::create($request->only('name','image_url','category_id','stock','price'));

        return redirect()->route('plants.index')
                         ->with('success', 'Plant created successfully.');
    }

    // Show single plant
    public function show($id)
    {
        $plant = Plant::findOrFail($id);
        return view('plants.show', compact('plant'));
    }

    // Show edit form
    public function edit($id)
    {
        $plant = Plant::findOrFail($id);
        $categories = Category::all();
        return view('plants.edit', compact('plant', 'categories'));
    }

    // Update plant
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $plant = Plant::findOrFail($id);
        $plant->update($request->only('name','image_url','category_id','stock','price'));

        return redirect()->route('plants.index')
                         ->with('success', 'Plant updated successfully.');
    }

    // Delete plant
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();

        return redirect()->route('plants.index')
                         ->with('success', 'Plant deleted successfully.');
    }
}
