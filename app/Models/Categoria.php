<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    
    protected $table = 'categorias';
     protected $fillable = [
        'nombre',
        'descripcion',
        'parent_id',
        'slug',
    ];

    /**
     * Relación con la categoría padre
     */
     public function parent()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }

    // Relación hijos
    public function children()
    {
        return $this->hasMany(Categoria::class, 'parent_id');
    }

    // Bienes de esta categoría
    public function bienes()
    {
        return $this->hasMany(Biene::class, 'categoria_id');
    }
}
