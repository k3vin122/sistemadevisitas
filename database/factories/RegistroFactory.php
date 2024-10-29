<?php

namespace Database\Factories;

use App\Models\Registro;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registro::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rut' => $this->faker->text(255),
            'nombres' => $this->faker->text(255),
            'apellidos' => $this->faker->text(255),
            'motivo' => $this->faker->text(255),
            'estado_id' => \App\Models\Estado::factory(),
            'proveedor_id' => \App\Models\Proveedor::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
