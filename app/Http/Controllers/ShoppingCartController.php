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

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $validated['quantity'] ?? 1;

        $existing = ShoppingCart::where('product_id', $validated['product_id'])->first();

        if ($existing) {
            $existing->quantity += $quantity;
            $existing->save();
        } else {
            ShoppingCart::create([
                'product_id' => $validated['product_id'],
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove($id)
    {
        $item = ShoppingCart::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item removido do carrinho.');
    }

    public function payment()
    {

        return redirect()->route('payment');
    }

    public function checkout()
    {
        ShoppingCart::truncate();

        return redirect()->route('home')->with('success', 'Pagamento confirmado com sucesso!');
    }
}
