<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $name = fake()->userName();
        $idPersonas =rand(1,10);
        $idRoles = rand(1,3);
        return [
            'idPersona'=>$idPersonas,
            'usuario'=>$name,
            'password'=>fake()->numberBetween(),
            'email'=>fake()->email(),
            
            'fecha'=>date('Y-m-d'),
            'idRol'=>$idRoles,
            'fechaCreacion'=>date('Y-m-d'),
            'fechaModificacion'=>date('Y-m-d'),
            'usuarioCreacion'=>$name,
            'usuarioModificacion'=>$name,
        ];
    }
}
