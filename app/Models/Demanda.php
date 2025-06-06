<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'demandas';

    protected $fillable = [
        'ref',
        'nombre',
        'fecha',
        'telefono',
        'telefono_2',
        'zona',
        'zona_2',
        'num_hab',
        'num_hab_2',
        'precio',
        'precio_2',
        'descripcion',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->firstOrFail();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('ref', 'like', '%'.$search.'%')
                    ->orWhere('nombre', 'like', '%'.$search.'%')
                    ->orWhere('telefono', 'like', '%'.$search.'%')
                    ->orWhere('fecha', 'like', '%'.$search.'%');
            });
        });
    }
}
