<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Routing\RouteGroup;

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
    return view('Empleado.index');
});
Route::prefix('empleado')->group(function () {
    Route::get('/new', [EmpleadoController::class, 'new'])->name('empleado.new');    
    Route::post('create', [EmpleadoController::class, 'create'])->name('empleado.create');
    Route::get('/show', [EmpleadoController::class, 'show'])->name('empleado.show');
    Route::post('update', [EmpleadoController::class, 'update'])->name('empleado.update');
    Route::get('/index', [EmpleadoController::class, 'index'])->name('empleado.index');    
    Route::get('/ajaxEmpleado', [EmpleadoController::class, 'ajaxEmpleado'])->name('empleado.ajaxEmpleado');

});



