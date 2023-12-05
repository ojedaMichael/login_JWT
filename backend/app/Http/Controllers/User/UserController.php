<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();

        return response()->json(compact('usuarios'), 200);
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
        $usuario = new User();

        $usuario->idPersona = $request->idPersona;
        $usuario->name = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = bcrypt( $request->password);
        $usuario->habilitado = 1;
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
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->habilitado = $request->habilitado;
        $user->fecha = date('y-m-d');
       
        $user->fechaModificacion = date('y-m-d');
        
        
        $user->save();
        return "usuario editado correctamente";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return "usuario eliminado correctamente";
    }
}
