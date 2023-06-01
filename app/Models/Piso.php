<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    protected $table = 'pisos';

    protected $fillable = [
        'fecha',
        'nombre',
        'tipo_piso',
        'zona',
        'precio',
        'num_hab',
        'muebles',
        'descripcion',
        'telefono',
        'propietario',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%'.$search.'%');
            });
        });
    }
}
