<?php

namespace App\Http\Controllers;

use App\Models\bitacora;

use Illuminate\Http\Request;

class BitacorataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return bitacora::all();
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
        $bitacora = new bitacora();

        $bitacora->bitacora = $request->bitacora;
        $bitacora->idUsuario = $request->idUsuario;
        $bitacora->fecha = date("Y-m-d H:i:s");
        $bitacora->IP = $request->IP;
        $bitacora->SO = $request->SO;
        $bitacora->navegador = $request->navegador;
        $bitacora->usuario = $request->usuario;
        
        $bitacora->save();

        return "bitacora registrada correctamente";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return bitacora::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bitacora $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bitacora = bitacora::find($id);

        $bitacora->bitacora = $request->bitacora;
        $bitacora->idUsuario = $request->idUsuario;
        $bitacora->fecha = date("Y-m-d H:i:s");
        $bitacora->IP = $request->IP;
        $bitacora->SO = $request->SO;
        $bitacora->navegador = $request->navegador;
        $bitacora->usuario = $request->usuario;
        
        $bitacora->save();

        return "bitacora editada correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bitacora = bitacora::find($id);
        $bitacora->delete();

        return "bitacora eliminada correctamente";
    }
}