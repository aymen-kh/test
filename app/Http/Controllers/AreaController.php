<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AreaController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $areas = Area::with('tables')->get();
        return view('areas.index', compact('areas'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('areas.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $area = new Area();
        $area->name = $request->name;
        $area->description = $request->description;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $area->image = $imagePath;
        }
        $area->save();

        return redirect()->route('areas.index')->with('success', 'Area created successfully.');
    }

    // Display the specified resource along with its tables
    public function show(Area $area)
    {
        // Eager load tables with the area
        $area->load('tables');
        return view('areas.show', compact('area'));
    }

    // Show the form for editing the specified resource
    public function edit(Area $area)
    {
        
        return view('areas.edit', compact('area'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $area->name = $request->name;
        $area->description = $request->description;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($area->image) {
                Storage::delete('public/' . $area->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $area->image = $imagePath;
        }
        $area->save();

        return redirect()->route('areas.index')->with('success', 'Area updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Area $area)
    {
        // Delete associated images if they exist
        if ($area->image) {
            Storage::delete('public/' . $area->image);
        }
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Area deleted successfully.');
    }
    
}
