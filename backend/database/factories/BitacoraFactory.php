<?php

namespace Database\Factories;

use Faker\Provider\Lorem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\bitacora>
 */
class BitacoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
    public function definition(): array
    {
        $so = ['windows',"MacIOS","linux"];
        $navegador = ['chrome','mozila','opera','brave','tor'];
        $numID = rand(1,10);
        return [
            'bitacora'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'idUsers'=>$numID,
            'fecha'=>date("Y-m-d H:i:s"),
            'IP'=>fake()->numberBetween(),
            'SO'=>$so[rand(0,2)],
            'navegador'=>$navegador[rand(0,4)],
            'usuario'=>fake()->name(),
        ];
    }
}
