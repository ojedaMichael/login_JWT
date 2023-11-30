<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return usuario::all();
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
        $usuario = new usuario();

        $usuario->idPersona = $request->idPersona;
        $usuario->usuario = $request->usuario;
        $usuario->clave = $request->clave;
        $usuario->habilitado = $request->habilitado;
        $usuario->fecha = date('y-m-d');
        $usuario->idRol = $request->idRol;
        $usuario->fechaModificacion = date('y-m-d');
        $usuario->fechacreacion = date('y-m-d');
        $usuario->usuarioCreacion = $request->usuarioCreacion;
        $usuario->usuarioModificacion = $request->usuarioCreacion;
        
        $usuario->save();

        return "usuario registrado correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return usuario::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = usuario::find($id);

        $usuario->idPersona = $request->idPersona;
        $usuario->usuario = $request->usuario;
        $usuario->clave = $request->clave;
        $usuario->habilitado = $request->habilitado;
        $usuario->fecha = date('y-m-d');
        $usuario->idRol = $request->idRol;
        $usuario->fechaModificacion = date('y-m-d');
        $usuario->usuarioModificacion = $request->usuarioModificacion;
        
        $usuario->save();
        return "usuario editado correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = usuario::find($id);
        $usuario->delete();

        return "usuario eliminado correctamente";
    }
}