<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return persona::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $persona = new persona();

        $persona->primerNombre = $request->primerNombre;
        $persona->segundoNombre = $request->segundoNombre;
        $persona->primerApellido = $request->primerApellido;
        $persona->seguandoApellido = $request->seguandoApellido;
        $persona->fechaCreacion = date('y-m-d');
        $persona->fechaModificacion = date('y-m-d');
        $persona->usuariocreacion = $request->usuariocreacion;
        $persona->usuarioModificacion = $request->usuariocreacion;
        
        $persona->save();

        return "persona registrada correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return persona::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $persona = persona::find($id);

        $persona->primerNombre = $request->primerNombre;
        $persona->segundoNombre = $request->segundoNombre;
        $persona->primerApellido = $request->primerApellido;
        $persona->seguandoApellido = $request->seguandoApellido;
        $persona->fechaModificacion = date('y-m-d');
        $persona->usuarioModificacion = $request->usuarioModificacion;
        
        $persona->save();
        return "persona editada correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persona = persona::find($id);
        $persona->delete();

        return "persona eliminada correctamente";
    }
}