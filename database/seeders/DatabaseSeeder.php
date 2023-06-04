<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Piso;
use App\Models\Account;
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
        $account = Account::create(['name' => 'Inverpromo']);

        User::factory()->create([
            'account_id' => $account->id,
            'name' => 'Carmen Gaitán',
            'email' => 'inverpromo7@gmail.com',
            'direccion' => 'Carrer Amer 22 A bajos',
            'telefono' => '672 72 87 77',
            'password' => '7557',
        ]);

        User::factory()->create([
            'account_id' => $account->id,
            'name' => 'Andreu Salleras',
            'email' => 'andreusadurnisg@gmail.com',
            'direccion' => 'Carrer Amer 22 A bajos',
            'telefono' => '645 43 28 17',
            'password' => '7557',
        ]);

        Piso::factory(10)->create();
    }
}
