<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubidaTarea extends Model
{
    protected $fillable = [
        'alumno_id', 	
        'tarea_id', 	
        'ruta_archivo', 	
        'fecha_entrega'
    ];

    public function tarea(){
        return $this->belongsTo(Tarea::class);
    }
}
