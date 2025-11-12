<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoFactory> */
    use HasFactory;

    protected $table = 'estados';
    protected $fillable = [
        'nombre', 
        'descripcion'
    ];
    public function bienes()
    {
        return $this->hasMany(Biene::class, 'estado_id');
    }
}
