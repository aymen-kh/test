<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Permission;

class ItemController extends Controller
{

    public function index()
    {
        $x=Auth::user();
        if($x){
            if($x->hasPermissionTo('item_edit')){
                $categories = Category::with('items')->get();        
                return view('items.index', compact('categories'));
        }
       
    }
abort('403');
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
       //dd($request->cookingTime);
        $item = new Item();
        $item->name = $request->input('name');
        $item->cookingTime = $request->cookingTime;
        $item->availability = $request->input('availability');
        $item->price = $request->input('price');
        $item->image = $request->input('image');
        $item->discount = $request->input('discount');
        $item->category_id = $request->input('category_id');
        if ($request->hasFile('image')) {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
            $item->image = $imageName;
        }
    
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
        if (request()->has('ajax')) {
            $item = Item::with('category')->findOrFail($id);
            return response()->json($item);
        }
    
        // For non-AJAX requests, you can return a view or redirect
        return redirect('/order');  // Redirect to an appropriate view
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('item_edit')) {
        $item = Item::find($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }
    abort('403');
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
        $item->image = $request->input('description');
        $item->discount = $request->input('discount');
        $item->category_id = $request->input('category_id');
        if ($request->hasFile('image')) {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
            $item->image = $imageName;
        }
    
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
        if(Auth::user()->can('item_edit')){
            $item = Item::find($id);
            $item->delete();
            return redirect()->route('items.index');
        }
     abort('403');
    }
}
