<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard'); 
})->middleware('auth')->name('dashboard.dashboard');

/**Ruta para crear el empleado***/
Route::post('/empleados/store', [EmpleadoController::class, 'store'])->name('empleados.store');

/**Ruta para enlistar los empleado***/
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');

// Rutas de la API para obtener empleados
Route::get('/api/empleados', [EmpleadoController::class, 'indexApi'])->name('api.empleados');

/**Ruta para editar los empleado***/

Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');

/**Rutas los cargos***/
Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::get('/cargos/{id}/edit', [CargoController::class, 'edit'])->name('cargos.edit');
Route::put('/cargos/{id}', [CargoController::class, 'update'])->name('cargos.update');
Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');








