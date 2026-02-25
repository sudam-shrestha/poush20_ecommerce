<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with(['product', 'product_varient', 'seller'])
            ->where('user_id', Auth::guard('web')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return CartResource::collection($carts);
    }

    public function store(Request $request)
    {
        $varient = ProductVarient::find($request->varient_id);
        $product = $varient->product;
        $seller = $product->seller;
        $user = Auth::guard('web')->user();
        $amount = $varient->price - ($varient->price * $product->discount / 100);

        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_varient_id', $varient->id)
            ->first();

        if ($existingCart) {
            $existingCart->qty += 1;
            $existingCart->amount = $amount * $existingCart->qty;
            $existingCart->save();
        } else {
            $cart = new Cart();
            $cart->qty = 1;
            $cart->user_id = $user->id;
            $cart->seller_id = $seller->id;
            $cart->product_id = $product->id;
            $cart->product_varient_id = $varient->id;
            $cart->amount = $amount;
            $cart->save();
        }
        return response()->json([
            "success" => true,
            "message" => "Product added to cart successfully"
        ]);
    }


    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart->user_id !== Auth::id()) {
            return response()->json([
                "success" => false,
                "message" => "Cart not found"
            ]);
        }

        $action = $request->input('action');

        $changed = false;

        if ($action === 'increment') {
            $cart->qty += 1;
            $changed = true;
            return response()->json([
                "success" => true,
                "message" => "Quantity increased"
            ]);
        } elseif ($action === 'decrement') {
            if ($cart->qty > 1) {
                $cart->qty -= 1;
                $changed = true;
                return response()->json([
                    "success" => true,
                    "message" => "Quantity decreased"
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Minimum quantity is 1"
                ]);
            }
        }

        if ($changed) {
            $variant = $cart->product_varient;
            $product = $variant->product;
            $amount = $variant->price - ($variant->price * $product->discount / 100);
            $cart->amount = $amount * $cart->qty;
            $cart->save();
            return response()->json([
                "success" => true,
                "message" => "Cart quantity updated"
            ]);
        }


        return response()->json([
            "success" => false,
            "message" => "Invalid action"
        ]);
    }


    public function delete($id)
    {
        $cart = Cart::find($id);

        if ($cart->user_id != Auth::guard('web')->user()->id) {
            return response()->json([
                "success" => false,
                "message" => "Cart not found"
            ]);
        }

        $cart->delete();

        return response()->json([
            "success" => true,
            "message" => "Item removed from cart"
        ]);
    }
}
