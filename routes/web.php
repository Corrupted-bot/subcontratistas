<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\SubcontratistasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//AZURE REDIRECCIONES
Route::get('/signin', 'App\Http\Controllers\AuthController@signin');
Route::get('/callback', 'App\Http\Controllers\AuthController@callback');
Route::get('/signout', 'App\Http\Controllers\AuthController@signout');


//PAGINAS
Route::get('/welcome', 'App\Http\Controllers\HomeController@welcome');
Route::get('/','App\Http\Controllers\AuthController@login');
Route::get("/registrar",'App\Http\Controllers\AuthController@registrar');
Route::get("/recuperar",'App\Http\Controllers\AuthController@recuperar');
Route::post("/recuperar-pass",'App\Http\Controllers\AuthController@recuperar_pass');


//BASE DE DATOS
Route::post('/iniciar-sesion', 'App\Http\Controllers\AuthController@IniciarSesion');
Route::get('/cerrar-sesion', 'App\Http\Controllers\AuthController@CerrarSesion');


Route::resource("/subcontratistas",SubcontratistasController::class);
Route::resource("/contrato",ContratoController::class);
