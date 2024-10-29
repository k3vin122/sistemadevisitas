<?php

namespace Database\Factories;

use App\Models\Estado;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estado::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_estado' => $this->faker->text(255),
        ];
    }
}
