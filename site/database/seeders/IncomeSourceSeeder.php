<?php

namespace Database\Seeders;

use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeSourceSeeder extends Seeder
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
        IncomeSource::factory(2)->for($user1)->create();
        IncomeSource::factory(2)->for($user2)->create();
    }
}
