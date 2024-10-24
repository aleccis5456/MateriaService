<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaTarea extends Model
{
    protected $fillable = [
        'tarea_id', 	
        'alumno_id', 	
        'nota'
    ];

    public function tarea(){
        return $this->belongsTo(Tarea::class);
    }
}
