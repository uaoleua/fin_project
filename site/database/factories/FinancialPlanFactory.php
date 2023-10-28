<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialPlan>
 */
class FinancialPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => fake()->randomFloat(2, 0, 10000),
            'date' => fake()->date(),
            'user_id' => User::factory(),
            'category_id' => Category::all()->random()->id,
            'currency_id' => Currency::all()->random()->id,
        ];
    }
}
