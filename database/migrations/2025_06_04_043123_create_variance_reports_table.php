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
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('store_id')->index();
            $table->date('start_date');//data outputted as year-month-day
            $table->date('end_date');//data outputted as year-month-day
            $table->decimal('physical_stock', 10, 2)->default(0.00);
            $table->decimal('system_stock', 10, 2)->default(0.00);
            $table->decimal('stock_difference', 10, 2)->default(0.00);
            $table->decimal("physical_sales", 10, 2)->default(0.00);
            $table->decimal("system_sales", 10, 2)->default(0.00);
            $table->decimal('sales_difference', 10, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
