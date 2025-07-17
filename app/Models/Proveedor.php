<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'telefono', 'direccion', 'contacto'];
    protected $table = 'proveedores';

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
