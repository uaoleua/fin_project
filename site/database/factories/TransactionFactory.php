<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'description' => fake()->sentence(5),
            'timestamp' => fake()->date(),
            'amount' => fake()->randomFloat(2, 0, 10000),
            'type' => fake()->randomElement(['plus', 'minus']),
            'user_id' => User::all()->random()->id,
            'account_id' => Account::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'income_source_id' => IncomeSource::all()->random()->id,
            'currency_id' => Currency::all()->random()->id,
        ];
    }
}
