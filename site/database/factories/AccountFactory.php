<?php

namespace Database\Factories;

use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_name' => fake()->sentence(3),
            'balance' => fake()->randomFloat(2, 0, 10000),
            'user_id' => User::all()->random()->id,
            'income_sources_id' => IncomeSource::all()->random()->id,
        ];
    }
}
