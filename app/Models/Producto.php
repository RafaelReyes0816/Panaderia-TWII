<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen'];
    protected $table = 'productos';

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
