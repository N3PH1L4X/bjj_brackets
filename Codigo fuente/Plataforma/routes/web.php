<?php

use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\DeporteCategoriaController;
use App\Http\Controllers\InscripcionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CompetidorController::class, "index"])->name("competidor.index");
Route::get('/competidores', [CompetidorController::class, "index"])->name("competidor.index");
Route::post('/addcompetidor', [CompetidorController::class,'add'])->name('competidor.add');
Route::post('borrarcompetidor/{id}', [CompetidorController::class,'borrar'])->name('competidor.borrar');
Route::post('editarcompetidor', [CompetidorController::class,'editar'])->name('competidor.editar');

Route::get('/inscripciones', function () {
    return view('inscripcion');
});

Route::get('/instructores', [InstructorController::class, "index"])->name("instructor.index");
Route::post('/addinstructor', [InstructorController::class,'add'])->name('instructor.add');
Route::post('borrarinstructor/{id}', [InstructorController::class,'borrar'])->name('instructor.borrar');
Route::post('editarinstructor', [InstructorController::class,'editar'])->name('instructor.editar');

Route::get('/escuelas', [EscuelaController::class, "index"])->name("escuela.index");
Route::post('/addescuela', [EscuelaController::class,'add'])->name('escuela.add');
Route::post('borrarescuela/{id}', [EscuelaController::class,'borrar'])->name('escuela.borrar');
Route::post('editarescuela', [EscuelaController::class,'editar'])->name('escuela.editar');

Route::get('/eventos', [EventoController::class, "index"])->name("evento.index");
Route::post('/addevento', [EventoController::class,'add'])->name('evento.add');
// Route::post('borrarevento/{id}', [EventoController::class,'borrar'])->name('evento.borrar');
Route::post('editarevento', [EventoController::class,'editar'])->name('evento.editar');


Route::get('/deportesycategorias', [DeporteCategoriaController::class, "index"])->name("deportcateg.index");
Route::post('/adddeporte', [DeporteCategoriaController::class,'deporteadd'])->name('deportcateg.deporteadd');
Route::post('/addcategoria', [DeporteCategoriaController::class,'categoriaadd'])->name('deportcateg.categoriaadd');
// Route::post('borrardeporte/{id}', [DeporteCategoriaController::class,'deporteborrar'])->name('deportcateg.deporteborrar');
// Route::post('borrarcategoria/{id}', [DeporteCategoriaController::class,'categoriaborrar'])->name('deportcateg.categoriaborrar');
// Route::post('editarescuela', [DeporteCategoriaController::class,'editar'])->name('deportcateg.editar');

Route::get('/inscripciones', [InscripcionController::class, "index"])->name("inscripcion.index");
Route::get('/obtenereventos', [InscripcionController::class, "obtenereventos"])->name("inscripcion.obtenereventos");
Route::get('/obtenercategorias/{idevento}', [InscripcionController::class, "obtenercategorias"])->name("inscripcion.obtenercategorias");
Route::post('/addinscripcion', [InscripcionController::class,'add'])->name('inscripcion.add');
Route::post('borrarinscripcion/{id}', [InscripcionController::class,'borrar'])->name('inscripcion.borrar');
Route::post('/editarinscripcion', [InscripcionController::class,'editar'])->name('inscripcion.editar');
