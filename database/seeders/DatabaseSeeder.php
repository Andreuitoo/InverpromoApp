<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Piso;
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
            'name' => 'Carmen Gaitán',
            'email' => 'inverpromo7@gmail.com',
            'direccion' => 'Carrer Amer 22 A bajos',
            'telefono' => '672 728 777',
            'password' => '7557',
        ]);

        User::factory()->create([
            'name' => 'Andreu Salleras',
            'email' => 'andreusadurnisg@gmail.com',
            'direccion' => 'Carrer Amer 22 A bajos',
            'telefono' => '645 43 28 17',
            'password' => '7557',
        ]);

        Piso::factory(5)->create();
    }
}
