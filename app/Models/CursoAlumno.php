<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoAlumno extends Model
{
    public $table = 'curso_alumno';
    protected $fillable = [
        'curso_id', 	
        'alumno_id'
    ];    
}
