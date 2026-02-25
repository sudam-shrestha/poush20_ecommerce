<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/products", [ApiController::class, "products"]);

Route::get("/product/{id}", [ApiController::class, "product"]);

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);


Route::middleware('auth:sanctum')->group(function () {

    Route::get("/carts", [CartController::class, "index"]);
    Route::post("/cart/store", [CartController::class, "store"]);
    Route::patch("/cart/{id}", [CartController::class, "update"]);
    Route::delete("/cart/{id}", [CartController::class, "delete"]);
    
});
