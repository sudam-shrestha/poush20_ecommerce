<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/products", [ApiController::class, "products"]);

Route::get("/product/{id}", [ApiController::class, "product"]);

Route::post("/register", [AuthController::class, "register"]);
