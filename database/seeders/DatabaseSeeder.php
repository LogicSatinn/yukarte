<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::create([
             'username' => 'LogicSatinn',
             'phone_number' => '+255692107171',
             'password' => 'password',
         ]);
    }
}
