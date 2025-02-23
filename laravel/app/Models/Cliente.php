<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
        'imagen'
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
