<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'telefono', 'direccion', 'contacto'];
    protected $table = 'proveedores';

    public static $rules = [
        'nombre' => 'required|string|max:100|min:2',
        'telefono' => 'required|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
        'direccion' => 'nullable|string|max:255|min:5',
        'contacto' => 'nullable|string|max:100|min:2',
    ];

    public static $rulesUpdate = [
        'nombre' => 'sometimes|required|string|max:100|min:2',
        'telefono' => 'nullable|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
        'direccion' => 'nullable|string|max:255|min:5',
        'contacto' => 'nullable|string|max:100|min:2',
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

    public function setContactoAttribute($value)
    {
        $this->attributes['contacto'] = $value ? trim($value) : null;
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

    public function getContactoFormateadoAttribute()
    {
        if (!$this->contacto) return 'No especificado';
        return ucwords(strtolower($this->contacto));
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
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

    public function scopeConContacto($query)
    {
        return $query->whereNotNull('contacto');
    }
}
