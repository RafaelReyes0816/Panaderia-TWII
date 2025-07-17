<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ['nombre', 'telefono', 'direccion', 'contacto'];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
