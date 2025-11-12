<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    protected $table = 'bajas';
    protected $fillable = [
        'bien_id',
        'fecha',
        'motivo',
        'director_id',
        'observaciones',
    ];
    public function bien()
    {
        return $this->belongsTo(Biene::class, 'bien_id');
    }

    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }
}
