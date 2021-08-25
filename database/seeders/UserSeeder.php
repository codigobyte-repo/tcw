<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Martin Aquino',
            'email' => 'maquino@codigobyte.com.ar',
            'password' => bcrypt('Maquino*2030')
        ])->assignRole('Admin');
        User::factory(9)->create();
    }
}
