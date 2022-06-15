<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'edad' => $this->faker->randomNumber(2, true),
            'sexo' => $this->faker->randomElement(['1', '2']),
            'telefono' => $this->faker->randomNumber(8, true),
            'carrera' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'matricula' => $this->faker->randomNumber(8,true),
            'culturaetnia' => $this->faker->randomElement(['1', '2']),
            'municipio_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15','16']),
            'discapacidad' => $this->faker->randomElement(['1', '2']),
            'taller_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15','16']),
            'user_id' => User::factory(),
        ];
    }
}
