<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SellerController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [PageController::class, "home"])->name("home");

Route::post("/seller/request", [SellerController::class, "seller_request"])->name("seller.request");
