<?php

use App\Http\Controllers\ActasController;
use App\Http\Controllers\Asignaciones\AsignacionController;
use App\Http\Controllers\Cortes\CorteController;
use App\Http\Controllers\Docentes\DocenteController;
use App\Http\Controllers\Egresados\EgresadoController;
use App\Http\Controllers\Estudiante\EstudianteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Materias\MateriaController;
use App\Http\Controllers\TrabajosGrado\TrabGradoController;
use App\Http\Controllers\UserController;
use App\Mail\ContactenosMailable;
use App\Models\Egresado;
use App\Models\Materia;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
// 	return redirect('/home');
// });

Route::get('/', [HomeController::class, 'inicio']);
Route::post('/', [HomeController::class, 'enviar'])->name('enviar');


require __DIR__ . '/auth.php';

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::get('table-list', function () {
	return view('pages.table_list');
})->name('table')->middleware(['auth']);


//=================================================================================================Usuarios
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('/user/formuser', [UserController::class, 'formuser']);
	Route::post('/user/formuser', [UserController::class, 'regusuario']);
	Route::get('/user/formactualizar/{id}', [UserController::class, 'formActualizar']);
	Route::post('/user/formactualizar/{id}', [UserController::class, 'actualizar']);
	Route::get('/user/desactivar/{id}', [UserController::class, 'desactivar']);
	Route::get('/user/activar/{id}', [UserController::class, 'activar']);
});

//==================================================================================================Actas
Route::group(['middleware' => 'auth'], function () {
	Route::get('/acta', [ActasController::class, 'index'])->name('actas');
	Route::get('/formActa', [ActasController::class, 'formActa'])->name('formActa');
	Route::get('/formActaComite', [ActasController::class, 'formActaComite'])->name('formActaComite');
	Route::post('/acta', [ActasController::class, 'guardarActa'])->name('actas_guardar');
	Route::post('/actaComite', [ActasController::class, 'guardarActaComite'])->name('actas_guardarComite');
	Route::get('/responsables', [ActasController::class, 'responsables'])->name('responsables');
	Route::get('/responsablesComite', [ActasController::class, 'responsablesComite'])->name('responsablesComite');

	Route::delete('/actas/eliminar/{id}', [ActasController::class, 'eliminar'])->name('elimActa');
	Route::get('/descargarActa/{id}', [ActasController::class, 'descargarPDF'])->name('descargarActa');
});
///=================================================================================================Docentes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes');
	Route::get('/docente/{id}', [DocenteController::class, 'show']);
	Route::post('/docentes/form', [DocenteController::class, 'store'])->name('formStore');
	Route::get('/docente/form/{id}', [DocenteController::class, 'edit'])->name('formEdit');
	Route::post('/docente/actualizar/{id}', [DocenteController::class, 'update'])->name('formUpdate');
	Route::get('/docente/delete/prof/{id}', [DocenteController::class, 'delete'])->name('profesionDelete');
	Route::get('/docente/delete/area/{id}', [DocenteController::class, 'deleteArea']);

	Route::get('/docente/des/{id}', [DocenteController::class, 'desactivar']);
	Route::get('/docente/act/{id}', [DocenteController::class, 'activar']);

});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/egresados', [EgresadoController::class, 'index'])->name('egresadosIndex');
	Route::get('/egresados/programas/{id}', [EgresadoController::class, 'programas'])->name('egresadosProg');
	Route::post('/egresados/form', [EgresadoController::class, 'store'])->name('formStoreEgre');
	Route::post('/egresado/actualizar/{id}', [EgresadoController::class, 'update'])->name('formUpdateEgre');
	Route::get('/egresados/form/{id}', [EgresadoController::class, 'edit'])->name('formEditEgre');

	Route::get('/egresado/des/{id}', [EgresadoController::class, 'desactivar']);
	Route::get('/egresado/act/{id}', [EgresadoController::class, 'activar']);
});


///=================================================================================================cortes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/cortes', [CorteController::class, 'index'])->name('cortesIndex');
	Route::post('/corte/form', [CorteController::class, 'store'])->name('formStoreCorte');
	Route::get('/corte/form/{id}', [CorteController::class, 'edit'])->name('formEditCorte');
	Route::post('/corte/actualizar/{id}', [CorteController::class, 'update'])->name('formUpdateCorte');
	Route::get('/corte/destroy/{id}', [CorteController::class, 'destroy']);
});

///=================================================================================================Estudiantes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantesIndexs');
	Route::get('/niveles', [EstudianteController::class, 'niveles'])->name('estudiantesNiveles');
	Route::post('/estudiante/form', [EstudianteController::class, 'store'])->name('formStore');
	Route::post('/estudiante/act/{id}', [EstudianteController::class, 'update'])->name('formUpdate');
	Route::get('/estudiante/actu/{id}', [EstudianteController::class, 'edit'])->name('formEdit');
	Route::get('/estudiante/delete/prof/{id}', [EstudianteController::class, 'delete']);

	Route::get('/estudiante/des/{id}', [EstudianteController::class, 'desactivar']);
	Route::get('/estudiante/act/{id}', [EstudianteController::class, 'activar']);
});

///=================================================================================================materias
Route::group(['middleware' => 'auth'], function () {
	Route::get('/materias', [MateriaController::class, 'index'])->name('materiasIndex');
	Route::post('/materia/form', [MateriaController::class, 'store'])->name('formStoreMateria');
	Route::get('/materia/form/{id}', [MateriaController::class, 'edit'])->name('formEditMateria');
	Route::post('/materia/actualizar/{id}', [MateriaController::class, 'update'])->name('formUpdateCorte');
	Route::get('/materia/destroy/{id}', [MateriaController::class, 'destroy']);
});

///=================================================================================================Asignación docente
Route::group(['middleware' => 'auth'], function () {
	Route::get('/asignacion', [AsignacionController::class, 'index'])->name('asignacionIndex');
	Route::post('/asignacion/form', [AsignacionController::class, 'store'])->name('formStoreAsignacion');
	Route::get('/asignacion/form/{id}/{mat}', [AsignacionController::class, 'edit'])->name('formEditAsignacion');
	Route::post('/asignacion/actualizar/{id}/{mat}', [AsignacionController::class, 'update'])->name('formUpdateAsignacion');
	Route::get('/asignacion/destroy/{id}/{mat}', [AsignacionController::class, 'destroy']);
});

///=================================================================================================Trabajos de grado
Route::group(['middleware' => 'auth'], function () {
	Route::get('/trabajos', [TrabGradoController::class, 'index'])->name('trabGradoIndex');
	Route::post('/trabajos/form', [TrabGradoController::class, 'store'])->name('formStoreTrabGrado');
	Route::get('/trabajos/form/{id}', [TrabGradoController::class, 'edit'])->name('formEditTrabGrado');
	Route::post('/trabajos/actualizar/{id}', [TrabGradoController::class, 'update'])->name('formUpdateTrabGrado');

});
