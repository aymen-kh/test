<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('tables.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            
            'capacity' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        Table::create($request->all());

        return redirect()->route('tables.index')->with('success', 'Table created successfully.');
    }

    // Display the specified resource
    public function show(Table $table)
    {
        return view('tables.show', compact('table'));
    }

    // Show the form for editing the specified resource
    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'number' => 'required|integer',
            'status' => 'required|string',
            'capacity' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        $table->update($request->all());

        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('tables.index')->with('success', 'Table deleted successfully.');
    }
}
