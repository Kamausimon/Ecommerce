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
        $cart = $this->getCart($request);
        Log::info('Cart Contents:', $cart);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->input('product');
        $quantity = $request->input('quantity');

        $cart = $this->getCart($request);

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

        $this->saveCart($request, $cart);
        Log::info('Added to cart:', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to the cart');
    }
    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($request, $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function update(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        // Validate quantity
        if (!is_numeric($quantity) || $quantity < 1) {
            return redirect()->route('cart.index')->with('error', 'Invalid quantity specified!');
        }

        $cart = $this->getCart($request);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            $this->saveCart($request, $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        } else {
            return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
        }
    }
    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        // Enhanced logging
        Log::info('Cart cleared', ['session_id' => $request->session()->getId()]);

        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }

    private function getCart(Request $request)
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, $cart)
    {
        return $request->session()->put('cart', $cart);
    }
}
