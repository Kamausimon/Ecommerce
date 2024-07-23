<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Log;

class cartController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
        }

        $cart = $request->session()->get('cart', []);
        Log::info('Cart Contents:', $cart);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->input('product');
        $quantity = $request->input('quantity');

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity'] += $quantity;
        } else {
            $cart[$product['id']] = [
                'name' => $product['name'],
                'quantity' => ['quantity'],
                'price' => $product['price'],
                'image_path' => $product['image_path']
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to the cart');
    }
    public function remove()
    {
    }

    public function update()
    {
    }
    public function clear()
    {
    }
}
