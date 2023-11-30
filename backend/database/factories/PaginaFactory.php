<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pagina>
 */
class PaginaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estados = ['activo', 'inactivo'];
        $name = fake()->userName();
        return [
            'fechaCreacion'=>date('Y-m-d'),
            'fechaModificacion'=>date('Y-m-d'),
            'usuarioCreacion'=>$name,
            'usuarioModificacion'=>$name,
            'url'=>'www'.fake()->firstName().'.com',
            'estado'=>$estados[rand(0,1)],
            'nombre'=>fake()->firstName(),
            'descripcion'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'icono'=>'icono',
            'tipo'=>'Lorem ipsum',
        ];
    }
}
