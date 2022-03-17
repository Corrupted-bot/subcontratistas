<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('/ver/reportes',"App\Http\Controllers\PowerController@index");
Route::get('/crear/reporte',"App\Http\Controllers\PowerController@CrearReporte");
Route::get('/asignar',"App\Http\Controllers\PowerController@Asignar");
Route::get('/','App\Http\Controllers\AuthController@login');
Route::get("/registrar",'App\Http\Controllers\AuthController@registrar');




//BASE DE DATOS
Route::post('/iniciar-sesion', 'App\Http\Controllers\AuthController@IniciarSesion');
Route::get('/cerrar-sesion', 'App\Http\Controllers\AuthController@CerrarSesion');



//API
Route::get("/api/user/{cc}","App\Http\Controllers\PowerController@DatosUsuarios");
Route::post("/api/add/reporte","App\Http\Controllers\PowerController@AgregarRegistro");
Route::get("/api/add/asignar","App\Http\Controllers\PowerController@AsignarReportes");
Route::get("/api/get/asignaciones/{correo}","App\Http\Controllers\PowerController@ObtenerAsignaciones");
Route::post("/api/add/usuario","App\Http\Controllers\AuthController@registrarUsuario");