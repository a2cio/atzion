<?php

namespace Database\Factories;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empresa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->company,
            "description" => $this->faker->paragraph(3),
            "user_id" => User::all()->random()->id,
            "created_at" => now()
        ];
    }
}
