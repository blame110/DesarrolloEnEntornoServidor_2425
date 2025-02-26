<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Models\Mascota;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

//Ruta para el listado de clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
//Ruta para el borrado del cliente actual
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
//Ruta para cargar la vista de edicion del cliente seleccionado
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
//Ruta para actualizar el cliente seleccionado
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
//Ruta para cargar la vista de insercino
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
//Ruta para insertar un nuevo cliente
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
//Ruta para mostrar el cliente
Route::get('/clientes/show/{id}', [ClienteController::class, 'show'])->name('clientes.show');

Route::get('/prueba-factorias', function () {

    $cliente = Cliente::factory()->count(10)->create();

    $mascota = Mascota::factory()->count(10)->create();

    return response()->json([
        'clientes' => $cliente,
        'mascotas' => $mascota]);
});
