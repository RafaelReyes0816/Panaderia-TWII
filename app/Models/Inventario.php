<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = ['producto_id', 'tipo_movimiento', 'cantidad', 'fecha', 'observacion'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
