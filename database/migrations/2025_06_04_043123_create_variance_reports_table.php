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
        Schema::create('variance_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('physical_stock', 10, 2)->default(0.00);
            $table->decimal('system_stock', 10, 2)->default(0.00);
            $table->decimal('variance', 10, 2)->default(0.00);
            $table->decimal('variance_amount', 10, 2)->default(0.00);
            $table->timestamps();

            
            $table->foreign('store_id')->references('id')->on('stores__outlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variance_reports');
    }
};
