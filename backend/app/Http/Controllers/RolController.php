<?php

namespace App\Http\Controllers;

use App\Models\rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return rol::all();
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
        $rol = new rol();

        $rol->rol = $request->rol;
        $rol->fechaModificacion = date('y-m-d');
        $rol->fechacreacion = date('y-m-d');
        $rol->usuarioCreacion = $request->usuarioCreacion;
        $rol->usuarioModificacion = $request->usuarioCreacion;
        
        $rol->save();

        return "rol registrado correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return rol::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rol = rol::find($id);

        $rol->rol = $request->rol;
        $rol->fechaModificacion = date('y-m-d');
        $rol->usuarioModificacion = $request->usuarioModificacion;
        
        $rol->save();
        return "rol editado correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = rol::find($id);
        $rol->delete();

        return "rol eliminado correctamente";
    }
}