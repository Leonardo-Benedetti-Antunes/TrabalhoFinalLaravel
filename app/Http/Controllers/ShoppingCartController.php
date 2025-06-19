<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $items = ShoppingCart::with('product')->get();
        return view('shopping_cart', compact('items'));
    }
}
