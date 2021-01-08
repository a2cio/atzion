<?php

namespace Database\Seeders;

use App\Models\Empresa;
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
        User::factory()->times(1)->create([
            "name" => "ascensorestzion",
            "email" => "ascensorestzion@gmail.com",
            "password" => bcrypt("password")
        ]);
        Empresa::factory()->times(40)->create();
    }
}
