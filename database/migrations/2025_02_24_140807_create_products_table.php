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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("description");
            $table->decimal("price", 16, 2);
            $table->string("barcode")->unique();
            $table->string("sku")->unique();
            $table->string("stock")->default(0);
            $table->string('image')->nullable();
            $table->integer("flawed")->default(0);
            
            
            $table->unsignedBigInteger("category_id");
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

