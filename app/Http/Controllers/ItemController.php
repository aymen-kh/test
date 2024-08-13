<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{

    public function index()
    {
        $categories = Category::with('items')->get();        
        return view('items.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cookingTime' => 'required',
            'availability' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'discount' => 'numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->cookingTime = $request->input('cookingTime');
        $item->availability = $request->input('availability');
        $item->price = $request->input('price');
        $item->image = $request->input('image');
        $item->discount = $request->input('discount');
        $item->category_id = $request->input('category_id');
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::with('category')->findOrFail($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cookingTime' => 'required',
            'availability' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'discount' => 'numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->cookingTime = $request->input('cookingTime');
        $item->availability = $request->input('availability');
        $item->price = $request->input('price');
        $item->image = $request->input('image');
        $item->discount = $request->input('discount');
        $item->category_id = $request->input('category_id');
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('items.index');
    }
}
