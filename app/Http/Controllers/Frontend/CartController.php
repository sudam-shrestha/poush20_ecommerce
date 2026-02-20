<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
            toast('Cart quantity updated', 'success');
        } else {
            $cart = new Cart();
            $cart->qty = 1;
            $cart->user_id = $user->id;
            $cart->seller_id = $seller->id;
            $cart->product_id = $product->id;
            $cart->product_varient_id = $varient->id;
            $cart->amount = $amount;
            $cart->save();
            toast('Product added to cart', 'success');
        }
        return redirect()->route('carts');
    }

    public function index()
    {
        $carts = Cart::with(['product', 'product_varient', 'seller'])
            ->where('user_id', Auth::guard('web')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.carts', compact('carts'));
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $action = $request->input('action');

        $changed = false;

        if ($action === 'increment') {
            $cart->qty += 1;
            $changed = true;
            toast('Quantity increased', 'success');
        } elseif ($action === 'decrement') {
            if ($cart->qty > 1) {
                $cart->qty -= 1;
                $changed = true;
                toast('Quantity decreased', 'success');
            } else {
                toast('Minimum quantity is 1', 'info');
                return redirect()->route('carts');
            }
        } else {
            return response()->json(['error' => 'Invalid action'], 400);
        }

        if ($changed) {
            $variant = $cart->product_varient;
            $product = $cart->product;

            $unitPriceAfterDiscount = $variant->price - ($variant->price * $product->discount / 100);

            $cart->amount = $unitPriceAfterDiscount * $cart->qty;
            $cart->save();
        }

        return redirect()->route('carts');
    }

    public function delete($id)
    {
        $cart = Cart::find($id);

        if ($cart->user_id != Auth::guard('web')->user()->id) {
            abort(403);
        }

        $cart->delete();

        toast('Item removed from cart', 'success');

        return redirect()->route('carts');
    }

    
}
