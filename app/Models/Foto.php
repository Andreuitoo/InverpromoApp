<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['ruta'];

    public function piso()
    {
        return $this->belongsTo(Piso::class);
    }
}
