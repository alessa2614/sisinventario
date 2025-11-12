<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Director;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estado;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biene>
 */
class BieneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_patrimonial' => $this->faker->unique()->bothify('CP-#####'),
            'descripcion' => $this->faker->sentence(),
            'marca' => $this->faker->optional()->word(),
            'modelo' => $this->faker->optional()->word(),
            'serial' => $this->faker->unique()->bothify('SN-########'),
            'color' => $this->faker->optional()->safeColorName(),
            'medidas' => $this->faker->randomElement(['10x20x30 cm', '15x25x35 cm', '20x30x40 cm']),
            'fecha_adquisicion' => $this->faker->optional()->date(),
            'valor_inicial' => $this->faker->optional()->randomFloat(2, 100, 10000),
            'depreciacion' => $this->faker->optional()->randomFloat(2, 0, 5000),
            'area_id' => Area::inRandomOrder()->value('id') ?? 1,
            'estado_id' => Estado::inRandomOrder()->value('id') ?? 1,

            'director_id' =>Director::inRandomOrder()->value('id') ?? 1,
            'observaciones' => $this->faker->optional()->sentence(),
        ];
    }
}
