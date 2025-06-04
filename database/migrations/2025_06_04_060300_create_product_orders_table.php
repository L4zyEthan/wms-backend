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
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("store_id");
            $table->unsignedBigInteger("transaction_type_id");
            $table->decimal("total_transaction_price", 16, 2)->default(0);
            $table->string("note")->nullable();
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign("store_id")->references("id")->on("stores__outlets");
            $table->foreign("transaction_type_id")->references("id")->on("transaction__types");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
