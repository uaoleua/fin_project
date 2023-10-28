<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
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
        Account::factory(2)->for($user1)->create();
        Account::factory(2)->for($user2)->create();
    }
}
