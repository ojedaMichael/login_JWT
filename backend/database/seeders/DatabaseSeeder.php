<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
           $seederPersona = new PersonaSeeder();
           $seederPagina = new PaginaSeeder();
           $seederRol = new RolSeeder();
           $seederEnlace = new EnlaceSeeder();
           $seederUsuario = new UsuarioSeeder();
           $seedersBitacora = new BitacoraSeeder();
            
           $seederPersona->run();
           $seederPagina->run();
           $seederRol->run();
           $seederEnlace->run();
           $seederUsuario->run();
           $seedersBitacora->run();
        
    }
}
