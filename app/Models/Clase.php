<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'profesor_id', 
        'curso_id', 
        'materia_id', 
        'hora_entrada', 
        'hora_salida', 
        'aula'
    ];

}
