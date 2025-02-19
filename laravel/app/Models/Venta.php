<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
   use HasFactory;

   protected $table = 'ventas';

   protected $fillable = [
      'cliente_id',
      'fecha',
      'total',
   ];

   public function cliente()
   {
      return $this->belongsTo(Cliente::class);
   }

   public function productos()
   {
      return $this->belongsToMany(Producto::class,'producto_venta')
      ->withPivot('cantidad');
   }
}
