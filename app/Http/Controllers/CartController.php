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

        //calculate total price
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $discount = $totalPrice * 0.00;

        // Calculate subtotal after discount
        $subtotal = $totalPrice - $discount;

        Log::info('Cart Contents:', $cart);
        return view('cart.index', compact('cart', 'totalPrice', 'discount', 'subtotal'));
    }

    public function proceedToPayment()
    {
        $cartTotal = $this->getCartTotal();
        session(['cartTotal' => $cartTotal]);

        Log::info('total acquired successfully' . $cartTotal);

        return redirect()->route('mpesa.form');
    }



    public function add(Request $request)
    {
        $product = $request->input('product');
        $quantity = (int)$request->input('quantity'); // Ensure quantity is an integer

        $cart = $this->getCart($request);

        // Check if the product already exists in the cart
        if (isset($cart[$product['id']])) {
            // Ensure that the current quantity is an integer before adding
            $currentQuantity = is_array($cart[$product['id']]['quantity']) ? 0 : (int)$cart[$product['id']]['quantity'];
            $cart[$product['id']]['quantity'] = $currentQuantity + $quantity;
        } else {
            // Add the product to the cart
            $cart[$product['id']] = [
                'name' => $product['name'],
                'quantity' => $quantity,
                'price' => $product['price'],
                'image_path' => $product['image_path']
            ];
        }

        // Save the updated cart back to the session
        $this->saveCart($request, $cart);

        // Log the cart's current state for debugging
        Log::info('Added to cart:', $cart);

        // Redirect back to the cart page with a success message
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
    private function  getCartTotal()
    {
        $cart = session('cart', []);

        //calculate total price
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }
}
