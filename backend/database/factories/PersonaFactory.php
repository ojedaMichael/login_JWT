<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->userName();
        return [
            'primerNombre'=>fake()->firstName(),
            'segundoNombre'=>fake()->firstName(),
            'primerApellido'=>fake()->lastName() ,
            'segundoApellido'=>fake()->lastName() ,
            'fechaCreacion'=>date('Y-m-d'),
            'fechaModificacion'=>date('Y-m-d'),
            'usuarioCreacion'=>$name,
            'usuarioModificacion'=>$name,
        ];
    }
}
