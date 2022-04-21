<?php

use App\Http\Controllers\ActasController;
use App\Http\Controllers\Cortes\CorteController;
use App\Http\Controllers\Docentes\DocenteController;
use App\Http\Controllers\Egresados\EgresadoController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
	return redirect('/home');
});

require __DIR__ . '/auth.php';

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('/acta', [ActasController::class, 'index'])->name('actas');
	Route::get('/formActa', [ActasController::class, 'formActa'])->name('formActa');
	Route::post('/acta', [ActasController::class, 'guardarActa'])->name('actas_guardar');
	Route::get('/responsables', [ActasController::class, 'responsables'])->name('responsables');
	Route::get('/actas/eliminar/{id}', [ActasController::class, 'eliminar'])->name('elimActa');
	Route::get('/descargarActa/{id}', [ActasController::class, 'descargarPDF'])->name('descargarActa');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');


	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
//Rutas usuarios
Route::get('/user/formuser', [UserController::class, 'formuser'])->middleware(['auth']);
Route::post('/user/formuser', [UserController::class, 'regusuario'])->middleware(['auth']);
Route::get('/user/formactualizar/{id}', [UserController::class, 'formActualizar'])->middleware(['auth']);
Route::post('/user/formactualizar/{id}', [UserController::class, 'actualizar'])->middleware(['auth']);
Route::get('/user/desactivar/{id}', [UserController::class, 'desactivar'])->middleware(['auth']);
Route::get('/user/activar/{id}', [UserController::class, 'activar'])->middleware(['auth']);

///=================================================================================================docentes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes');
	Route::get('/docentes/form', [DocenteController::class, 'create'])->name('form');
	Route::post('/docentes/form', [DocenteController::class, 'store'])->name('formStore');
	Route::get('/docente/form/{id}', [DocenteController::class, 'edit'])->name('formEdit');
	Route::post('/docente/actualizar/{id}', [DocenteController::class, 'update'])->name('formUpdate');
	Route::get('/docente/delete/{id}', [DocenteController::class, 'delete'])->name('profesionDelete');
	Route::get('/docente/show/{id}', [DocenteController::class, 'show'])->name('formShow');
	Route::get('/docente/desactivar/{id}', [DocenteController::class, 'desactivar']);
	Route::get('/docente/activar/{id}', [DocenteController::class, 'activar']);
});

///=================================================================================================egresados
Route::group(['middleware' => 'auth'], function () {
	Route::get('/egresados', [EgresadoController::class, 'index'])->name('egresadosIndex');
	Route::get('/egresados/programas/{id}', [EgresadoController::class, 'programas'])->name('egresadosProg');
	Route::post('/egresados/form', [EgresadoController::class, 'store'])->name('formStoreEgre');
	Route::get('/egresados/form/{id}', [EgresadoController::class, 'edit'])->name('formEditEgre');
	Route::post('/egresado/actualizar/{id}', [EgresadoController::class, 'update'])->name('formUpdateEgre');
	Route::get('/egresado/desactivar/{id}', [EgresadoController::class, 'desactivar']);
	Route::get('/egresado/activar/{id}', [EgresadoController::class, 'activar']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/cortes', [CorteController::class, 'index'])->name('cortesIndex');
	Route::post('/corte/form', [CorteController::class, 'store'])->name('formStoreCorte');
	Route::get('/corte/form/{id}', [CorteController::class, 'edit'])->name('formEditCorte');
	Route::post('/corte/actualizar/{id}', [CorteController::class, 'update'])->name('formUpdateCorte');
	Route::get('/corte/desactivar/{id}', [CorteController::class, 'desactivar']);
	Route::get('/corte/activar/{id}', [CorteController::class, 'activar']);
});