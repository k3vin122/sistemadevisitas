<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->text(255),
            'rut' => $this->faker->text(255),
        ];
    }
}
