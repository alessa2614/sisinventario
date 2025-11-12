<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    /** @use HasFactory<\Database\Factories\DirectorFactory> */
    use HasFactory;

    protected $table = 'directors';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'observaciones',
    ];
     public function bienes()
    {
        return $this->hasMany(Biene::class, 'director_id');
    }

    public function bajas()
    {
        return $this->hasMany(Baja::class, 'director_id');
    }
}
