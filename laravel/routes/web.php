<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Models\Mascota;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/prueba-factorias', function () {

    $cliente = Cliente::factory()->count(10)->create();

    $mascota = Mascota::factory()->count(10)->create();

    return response()->json([
        'clientes' => $cliente,
        'mascotas' => $mascota]);
});
