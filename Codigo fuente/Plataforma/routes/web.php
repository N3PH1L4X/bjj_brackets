<?php

use App\Http\Controllers\CompetidorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/competidores', [CompetidorController::class, "index"])->name("competidor.index");
Route::post('/addcompetidor', [CompetidorController::class,'add'])->name('competidor.add');
Route::post('borrarcompetidor/{id}', [CompetidorController::class,'borrar'])->name('competidor.borrar');
Route::post('editarcompetidor', [CompetidorController::class,'editar'])->name('competidor.editar');

Route::get('/inscripciones', function () {
    return view('inscripcion');
});
