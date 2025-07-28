<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen'];
    protected $table = 'productos';

    public static $rules = [
        'nombre' => 'required|string|max:100|min:2',
        'descripcion' => 'nullable|string|max:1000',
        'precio' => 'required|numeric|min:0|max:999999.99',
        'stock' => 'required|integer|min:0|max:999999',
        'imagen' => 'nullable|string|max:255',
    ];

    public static $rulesUpdate = [
        'nombre' => 'sometimes|required|string|max:100|min:2',
        'descripcion' => 'nullable|string|max:1000',
        'precio' => 'sometimes|required|numeric|min:0|max:999999.99',
        'stock' => 'sometimes|required|integer|min:0|max:999999',
        'imagen' => 'nullable|string|max:255',
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim($value);
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = $value ? trim($value) : null;
    }

    public function setPrecioAttribute($value)
    {
        $this->attributes['precio'] = round($value, 2);
    }

    public function getPrecioFormateadoAttribute()
    {
        return '$' . number_format($this->precio, 2);
    }

    public function getStockDisponibleAttribute()
    {
        return $this->stock > 0 ? $this->stock : 0;
    }

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

    public function scopeConStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeSinStock($query)
    {
        return $query->where('stock', '<=', 0);
    }

    public function scopePorNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', '%' . $nombre . '%');
    }
}
