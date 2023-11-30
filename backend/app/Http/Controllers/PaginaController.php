<?php

namespace App\Http\Controllers;

use App\Models\pagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return pagina::all();
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
        $pagina = new pagina();

        $pagina->url = $request->url;
        $pagina->estado = $request->estado;
        $pagina->icono = $request->icono;
        $pagina->tipo = $request->tipo;
        $pagina->descripcion = $request->descripcion;
        $pagina->fechaModificacion = date('y-m-d');
        $pagina->fechaCreacion = date('y-m-d');
        $pagina->usuarioCreacion = $request->usuarioCreacion;
        $pagina->usuarioModificacion = $request->usuarioCreacion;
        
        $pagina->save();

        return "pagina registrada correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return pagina::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pagina $pagina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pagina = pagina::find($id);

        $pagina->url = $request->url;
        $pagina->estado = $request->estado;
        $pagina->icono = $request->icono;
        $pagina->tipo = $request->tipo;
        $pagina->descripcion = $request->descripcion;
        $pagina->fechaModificacion = date('y-m-d');
        $pagina->usuarioModificacion = $request->usuarioModificacion;
        
        $pagina->save();
        return "pagina editada correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pagina = pagina::find($id);
        $pagina->delete();

        return "pagina eliminada correctamente";
    }
}