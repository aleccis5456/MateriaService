<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    public $table = 'examens';
    
    protected $fillable = [
        'profesor_id', 	
        'materia_id', 	
        'fecha_examen'
    ];

    public function notas(){
        return $this->hasMany(NotaExamen::class);
    }
}
