<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stores_Outlets;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VarianceReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class VarianceReportFactory extends Factory
{
    protected $model = VarianceReport::class;

    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-6 month', 'now');
        $end_date = $this->faker->dateTimeBetween($start_date, '+1 month');
        $physical_stock = $this->faker->numberBetween(0, 1000);
        $physical_sales = $this->faker->numberBetween(0, 100000);
        $system_stock = Product::sum('stock');
        $system_sales = Transaction::whereBetween('created_at',[$start_date,$end_date])->sum('total_transaction_price');
        return [
            'store_id' => Stores_Outlets::factory(),
            'start_date' => $start_date->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d'),
            'physical_stock' => $physical_stock,
            'system_stock' => $system_stock,
            'stock_difference' => $physical_stock - $system_stock,
            'physical_sales' => $physical_sales,
            'system_sales' => $system_sales,
            'sales_difference' => $physical_sales - $system_sales,
            'user_id' => User::factory(),
        ];
    }
}
