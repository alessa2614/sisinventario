<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biene extends Model
{
    /** @use HasFactory<\Database\Factories\BieneFactory> */
    use HasFactory;
    protected $table = 'bienes';
    protected $fillable = [
        'codigo_patrimonial', 
        'descripcion', 
        'area_id', 
        'estado_id',
        'fecha_adquisicion', 
        'numero_doc',
        'tipo_documento',
        'marca', 
        'modelo', 
        'serial', 
        'medidas', 
        'color', 
        'categoria_id',
        'valor_inicial', 
        'depreciacion', 
        'director_id', 
        'observaciones'
    ];

    // Relaciones de pertenencia (belongsTo)
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id');   
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relaciones de hijos (hasMany)
    public function bajas()
    {
        return $this->hasMany(Baja::class, 'bien_id');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'bien_id');
    }

    
}
