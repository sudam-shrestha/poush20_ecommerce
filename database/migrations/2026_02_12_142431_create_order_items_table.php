<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->double('amount');
            $table->foreignId('order_id')->constained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constained('products')->cascadeOnDelete();
            $table->foreignId('product_varient_id')->constained('product_varients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
