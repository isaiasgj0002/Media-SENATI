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
Route::post('/trabajos/crear', [TrabajoController::class, 'store'])->name('trabajos');
//Ruta de videos
Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('index.video');
Route::post('/videos/crear', [VideoController::class, 'store'])->name('create.video');
//Route::get('/videos/crear', [VideoController::class, 'store'])->name('create.video');
