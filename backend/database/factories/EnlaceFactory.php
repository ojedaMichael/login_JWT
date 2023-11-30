<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\enlace>
 */
class EnlaceFactory extends Factory
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
            'idPagina'=>rand(1,10),
            'idRol'=>rand(1,3),
            'descripcion'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'fechaCreacion'=>date('Y-m-d'),
            'fechaModificacion'=>date('Y-m-d'),
            'usuarioCreacion'=>$name,
            'usuarioModificacion'=>$name,
        ];
    }
}
