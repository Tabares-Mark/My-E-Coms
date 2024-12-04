<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request){
    $validated = $request->validate([
        'product_id' => 'required|exists:product,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::find($request->product_id);

    if ($product->quantity < $request->quantity) {
        return response()->json(['message' => 'Insufficient stock available'], 400);
    }

    // Add the product to the cart (create or update)
    $cart = Cart::updateOrCreate(
        ['user_id' => $request->user()->id, 'product_id' => $request->product_id],
        ['quantity' => $request->quantity]
    );

    return response()->json(['message' => 'Product added to cart', 'cart' => $cart], 200);
}

public function productCount(Request $request) {
    
    $Count = Cart::where('user_id', $request->user()->id)->count();
    return response()->json(['count' => $Count], 200);
}
    // View cart
    public function viewCart(Request $request)
    {


        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('product')
            ->get();

        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return response()->json(['cart' => $cartItems, 'total_price' => $total], 200);
    }



    // Update cart item quantity
    public function updateCart(Request $request, $cartId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::find($cartId);

        if (!$cart || $cart->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $product = $cart->product;

        if ($product->quantity < $request->quantity) {
            return response()->json(['message' => 'Insufficient stock available'], 400);
        }

        $cart->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated successfully', 'cart' => $cart], 200);
    }

    // Checkout cart
    public function checkout(Request $request)
    {
        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('product')
            ->get();

        $total = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;

            if ($product->quantity < $item->quantity) {
                return response()->json(['message' => "Insufficient stock for product: {$product->name}"], 400);
            }

            $product->update(['quantity' => $product->quantity - $item->quantity]);

            $total += $product->price * $item->quantity;
        }

        // Clear the cart
        Cart::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'Checkout successful', 'total_price' => $total], 200);
    }
}
