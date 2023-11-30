<?php

namespace App\Http\Controllers;

use App\Models\enlace;
use Illuminate\Http\Request;

class EnlaceController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return enlace::all();
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
        $enlace = new enlace();

        $enlace->idPagina = $request->idPagina;
        $enlace->idRol = $request->idRol;
        $enlace->descripcion = $request->descripcion;
        $enlace->fechaModificacion = date('y-m-d');
        $enlace->fechaCreacion = date('y-m-d');
        $enlace->usuarioCreacion = $request->usuarioCreacion;
        $enlace->usuarioModificacion = $request->usuarioCreacion;
        
        $enlace->save();

        return "enlace registrado correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return enlace::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(enlace $enlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $enlace = enlace::find($id);

        $enlace->idPagina = $request->idPagina;
        $enlace->idRol = $request->idRol;
        $enlace->descripcion = $request->descripcion;
        $enlace->fechaModificacion = date('y-m-d');
        $enlace->usuarioModificacion = $request->usuarioModificacion;
        
        $enlace->save();

        return "enlace editado correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $enlace =enlace::find($id);
        $enlace->delete();

        return "enlace eliminado correctamente";
    }
}