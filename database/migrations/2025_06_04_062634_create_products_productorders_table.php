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
        Schema::create('product_productorders', function (Blueprint $table) {
            $table->unsignedBigInteger('product_order_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity', 12, 2);
            $table->decimal('price', 12, 2);
            
            $table->primary(['product_order_id', 'product_id']);
            $table->foreign('product_order_id')->references('id')->on('product_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_productorders');
    }
};
