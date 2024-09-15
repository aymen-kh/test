<?php

namespace App\Http\Controllers;

use App\Models\Menu;
//use App\Models\Type;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        if ($user=Auth::user()){
       if ($user ->cannot('order_edit')){
           
            $menus = Menu::where('availability', 1)->get();

            return view('menus.index', compact('menus'));
        }}
       
        $menus = Menu::All();
    
        

        return view('menus.index', compact('menus'));

    }
    

    public function create()
    {
        if (Auth::user()->can('menu_edit')){
        $categories = Category::all();
        $items = Item::all();
        return view('menus.create', compact('items'));
    }
    abort('403');
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
        if (Auth::user()->can('menu_edit')){

        return view('menus.show', compact('menu'));
    }
    abort('403');
}
    public function edit(Menu $menu)
    {
        if (Auth::user()->can('menu_edit')){

        $categories = Category::all();
        $items = Item::all();
        return view('menus.edit', compact('menu', 'categories', 'items'));
    }
    abort('403');
}
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'rating' => 'nullable|numeric|min:0|max:10',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
        ]);
    
        if ($request->hasFile('image')) {
            // Remove old image if necessary
            if ($menu->image) {
                Storage::delete('public/' . $menu->image);
            }
    
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }
    
        $menu->update($validated);
        $menu->items()->sync($request->input('items', [])); // Sync items
    
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }
    

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}