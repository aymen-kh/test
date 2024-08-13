<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Type;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('menus.create', compact('items'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image',
        'availability' => 'required|boolean',
        'rating' => 'nullable|numeric|min:0|max:10',
        'items' => 'required|array',
        'items.*' => 'exists:items,id',
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $validated['image'] = $imagePath;
    }

    // Calculate the total price based on the selected items
    $items = Item::whereIn('id', $request->input('items'))->get();
    $totalPrice = $items->sum('price');
    $validated['price'] = $totalPrice;

    $menu = Menu::create($validated);
    $menu->items()->attach($request->input('items', [])); // Attach items

    return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
}

    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        $items = Item::all();
        return view('menus.edit', compact('menu', 'categories', 'items'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
        ]);

        $menu->update($validated);
        $menu->items()->sync($request->input('items', [])); // Use input() instead of items

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}