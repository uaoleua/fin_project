<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Currency::factory(3)->create();

        Currency::factory()->create(['currency_name' => 'гривня', 'symbol' => '&#8372;', 'code' => 'UAH']);
        Currency::factory()->create(['currency_name' => 'долар', 'symbol' => '$', 'code' => 'USD']);
        Currency::factory()->create(['currency_name' => 'євро', 'symbol' => '€', 'code' => 'EUR']);
    }
}
