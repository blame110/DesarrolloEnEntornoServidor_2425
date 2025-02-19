<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class,'producto_venta')
        ->withPivot('cantidad');
    }

}
