<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function products()
    {
        $products = Product::where('stock', true)->get();
        return ProductResource::collection($products);
    }

    public function product($id)
    {
        $product = Product::find($id);
        if(!$product) {
            return response()->json([
                "message" => "Product not found"
            ]);
        }
        return new ProductResource($product);
    }
}
