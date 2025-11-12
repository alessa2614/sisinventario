<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = [
        'bien_id',
        'fecha',
        'area_anterior',
        'area_nueva',
        'observaciones',
    ];
    public function bien()
    {
        return $this->belongsTo(Biene::class, 'bien_id');
    }

    public function areaAnterior()
    {
        return $this->belongsTo(Area::class, 'area_anterior');
    }

    public function areaNueva()
    {
        return $this->belongsTo(Area::class, 'area_nueva');
    }
}
