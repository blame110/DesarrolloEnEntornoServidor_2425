<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mascota;
use App\Models\Cliente;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mascota::factory()->count(20)->create()->each (function ($mascota) {
            //Cogemos un cliente aleatorio
            $cliente = Cliente::inRandomOrder()->first();
            //$mascota->update(['cliente_id' => $cliente->id]);
            $mascota->cliente_id = $cliente->id;
            $mascota->save();
        });
    }
}
