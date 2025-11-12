<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;

    protected $table = 'areas';
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    public function bienes()
    {
        return $this->hasMany(Biene::class, 'area_id');
    }
    public function movimientosAnteriores()
    {
        return $this->hasMany(Movimiento::class, 'area_anterior');
    }
    public function movimientosNuevos()
    {
        return $this->hasMany(Movimiento::class, 'area_nueva');
    }
}
