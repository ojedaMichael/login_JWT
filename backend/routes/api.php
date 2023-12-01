<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('auth')->group(function(){
    route::post('/register', [AuthController::class, 'register']);
    route::post('/login', [AuthController::class, 'login']);
});

Route::controller(BitacoraController::class)->group(function() {
    Route::get('/bitacoras', 'index');
    Route::get('/bitacoras/{id}', 'show');
    Route::post('/bitacoras', 'store');
    Route::put('/bitacoras/{id}', 'update');
    Route::delete('/bitacoras/{id}', 'destroy');    
});
Route::controller(EnlaceController::class)->group(function() {
    Route::get('/enlaces', 'index');
    Route::get('/enlaces/{id}', 'show');
    Route::post('/enlaces', 'store');
    Route::put('/enlaces/{id}', 'update');
    Route::delete('/enlaces/{id}', 'destroy');    
});
Route::controller(PaginaController::class)->group(function() {
    Route::get('/paginas', 'index');
    Route::get('/paginas/{id}', 'show');
    Route::post('/paginas', 'store');
    Route::put('/paginas/{id}', 'update');
    Route::delete('paginas/{id}', 'destroy');    
});
Route::controller(PersonaController::class)->group(function() {
    Route::get('/personas', 'index');
    Route::get('/personas/{id}', 'show');
    Route::post('/personas', 'store');
    Route::put('/personas/{id}', 'update');
    Route::delete('/personas/{id}', 'destroy');    
});
Route::controller(RolController::class)->group(function() {
    Route::get('/roles', 'index');
    Route::get('/roles/{id}', 'show');
    Route::post('/roles', 'store');
    Route::put('/roles/{id}', 'update');
    Route::delete('/roles/{id}', 'destroy');    
});
Route::controller(UsuarioController::class)->group(function() {
    Route::get('/usuarios', 'index');
    Route::get('/usuarios/{id}', 'show');
    Route::post('/usuarios', 'store');
    Route::put('/usuarios/{id}', 'update');
    Route::delete('/usuarios/{id}', 'destroy');    
});
