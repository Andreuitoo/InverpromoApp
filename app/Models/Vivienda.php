<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'viviendas';

    protected $fillable = [
        'fecha',
        'ref',
        'tipo',
        'propietario',
        'telefono',
        'zona',
        'zona_2',
        'precio_prop',
        'precio_venta',
        'terraza',
        'num_hab',
        'num_banos',
        'ascensor',
        'altura_planta',
        'coladuria',
        'garaje',
        'piscina',
        'balcon',
        'm2',
        'estado',
        'muebles',
        'carpinteria_int',
        'carpinteria_ext',
        'zona_comunitaria',
        'antiguedad',
        'direccion',
        'descripcion',
    ];

    public function fotosVivienda()
    {
        return $this->hasMany(FotosVivienda::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('ref', 'like', '%'.$search.'%')
                    ->orWhere('tipo', 'like', '%'.$search.'%')
                    ->orWhere('fecha', 'like', '%'.$search.'%')
                    ->orWhere('precio_prop', 'like', '%'.$search.'%')
                    ->orWhere('zona', 'like', '%'.$search.'%');
            });
        });
    }
}
