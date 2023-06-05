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
        'ref',
        'tipo_piso',
        'zona',
        'precio',
        'num_hab',
        'muebles',
        'descripcion',
        'telefono',
        'propietario',
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('ref', 'like', '%'.$search.'%')
                    ->orWhere('tipo_piso', 'like', '%'.$search.'%')
                    ->orWhere('fecha', 'like', '%'.$search.'%')
                    ->orWhere('precio', 'like', '%'.$search.'%')
                    ->orWhere('zona', 'like', '%'.$search.'%');
            });
        });
    }
}
