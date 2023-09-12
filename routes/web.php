<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiosController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas de estudios y trabajo
Route::post('/estudios/crear', [EstudiosController::class, 'store'])->name('estudios');
Route::patch('/estudios/editar/{id}', [EstudiosController::class, 'update'])->name('update.estudios');
Route::post('/trabajos/crear', [TrabajoController::class, 'store'])->name('trabajos');
Route::patch('/trabajos/editar/{id}', [TrabajoController::class, 'update'])->name('update.trabajos');
//Ruta de videos
Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('index.video');
Route::post('/videos/crear', [VideoController::class, 'store'])->name('create.video');
Route::delete('/videos/eliminar/{id}', [VideoController::class, 'destroy'])->name('destroy.video');
//Ruta de perfil de usuarios
Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('index.perfil');
Route::get('/perfil/{id}', [App\Http\Controllers\UserPerfilController::class, 'index'])->name('index.userpefil');
//envio de solicitudes
Route::get('/solicitud/{id}', [App\Http\Controllers\SolicitudController::class, 'enviar'])->name('enviar.solicitud');
Route::get('/solicitud/aceptar/{id}', [App\Http\Controllers\SolicitudController::class, 'aceptar'])->name('aceptar.solicitud');
Route::get('/solicitud/rechazar/{id}', [App\Http\Controllers\SolicitudController::class, 'rechazar'])->name('rechazar.solicitud');
//Comentarios
Route::post('/comentarios/publicar', [App\Http\Controllers\ComentariosController::class, 'create'])->name('create.comentario');
