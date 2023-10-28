<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $currencies = [
            ['name' => 'гривня', 'symbol' => '&#8372;', 'code' => 'UAH'],
            ['name' => 'долар', 'symbol' => '$', 'code' => 'USD'],
            ['name' => 'євро', 'symbol' => '€', 'code' => 'EUR'],
        ];

        $currency = $currencies[array_rand($currencies)];

        return [
            'currency_name' => $currency['name'],
            'symbol' => $currency['symbol'],
            'code' => $currency['code'],
        ];
    }
}
