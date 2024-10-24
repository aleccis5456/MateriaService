<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'profesor_id', 	
        'materia_id', 	
        'descripcion', 	
        'fecha_limite'
    ];

    public function materia(){
        return $this->belongsTo(Materia::class);
    }
}
