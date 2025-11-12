<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Director>
 */
class DirectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->numerify('#########'),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => null,
            'estado' => $this->faker->boolean(10), 
            'observaciones' => $this->faker->optional()->sentence(),
        ];
    }
}
