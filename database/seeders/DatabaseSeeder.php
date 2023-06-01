<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'first_name' => 'Maria Carmen',
            'last_name' => 'Gaitán Forteza',
            'email' => 'inverpromo7@gmail.com',
            'password' => '7557',
        ]);
    }
}
