<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\GenerateFirstCycle;
use App\Models\User;
use Carbon\Carbon;
use DefStudio\Telegraph\Models\TelegraphBot;
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

        TelegraphBot::create([
            'token' => config('services.telegram.token'),
            'name' => config('app.name')
        ]);
    }
}
