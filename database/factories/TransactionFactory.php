<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Stores_Outlets;
use App\Models\Transaction;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'store_id' => Stores_Outlets::inRandomOrder()->value('id'),
            'transaction_type_id' => $this->faker->randomElement([1, 2]),
            'total_transaction_price' => $this->faker->randomFloat(2, 100, 10000),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
            // 'products' is not a column, but for seeding, you can attach products in a factory state or after creation
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Transaction $transaction) {
            $products = Product::inRandomOrder()->take(rand(1, 3))->get();
            foreach ($products as $product) {
                $transaction->products()->attach($product->id, [
                    'quantity' => rand(1, 10),
                    'price' => $product->price,
                    'flawed' => rand(0,1),
                ]);
            }
        });
    }
}
