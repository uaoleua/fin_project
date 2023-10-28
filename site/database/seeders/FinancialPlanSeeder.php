<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinancialPlan;
use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user1 = $users ->find(2);
        $user2 = $users ->find(3);
        $currencies = Currency::all();
        $currency1 = $currencies ->find(1);
        FinancialPlan::factory(5)->for($user1)->for($currency1)->create();
        FinancialPlan::factory(5)->for($user2)->for($currency1)->create();
    }
}
