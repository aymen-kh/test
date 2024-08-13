<?php // app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'required|string',
            'price' => 'required|string',
        ]);

        // Retrieve existing cart from cookie or initialize a new one
        $cart = $request->cookie('cart') ? json_decode($request->cookie('cart'), true) : [];

        // Add new item to cart
        $cart[] = [
            'id' => $request->id,
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
        ];

        // Save updated cart to cookie
        return response()->json($cart)
            ->cookie('cart', json_encode($cart), 60); // Cookie lasts for 60 minutes
    }

    public function items(Request $request)
    {
        $cart = $request->cookie('cart') ? json_decode($request->cookie('cart'), true) : [];
        return response()->json($cart);
    }
}
