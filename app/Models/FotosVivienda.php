<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosVivienda extends Model
{
    use HasFactory;

    protected $table = 'fotosViviendas';

    protected $fillable = ['ruta'];

    public function vivienda()
    {
        return $this->belongsTo(Vivienda::class);
    }
}
