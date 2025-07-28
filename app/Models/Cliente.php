<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'telefono', 'direccion'];

    public static $rules = [
        'nombre' => 'required|string|max:100|min:2',
        'telefono' => 'nullable|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
        'direccion' => 'nullable|string|max:255|min:5',
    ];

    public static $rulesUpdate = [
        'nombre' => 'sometimes|required|string|max:100|min:2',
        'telefono' => 'nullable|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
        'direccion' => 'nullable|string|max:255|min:5',
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim($value);
    }

    public function setTelefonoAttribute($value)
    {
        $this->attributes['telefono'] = $value ? trim($value) : null;
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = $value ? trim($value) : null;
    }

    public function getNombreCompletoAttribute()
    {
        return ucwords(strtolower($this->nombre));
    }

    public function getTelefonoFormateadoAttribute()
    {
        if (!$this->telefono) return 'No especificado';
        return $this->telefono;
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function scopePorNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', '%' . $nombre . '%');
    }

    public function scopeConTelefono($query)
    {
        return $query->whereNotNull('telefono');
    }

    public function scopeSinTelefono($query)
    {
        return $query->whereNull('telefono');
    }
}
