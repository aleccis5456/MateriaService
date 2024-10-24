<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaExamen extends Model
{
    public $table = 'nota_examens';

    protected $fillable = [
        'examen_id', 
        'alumno_id', 	
        'nota' 
    ];

    public function examen(){
        return $this->belongsTo(Examen::class);
    }
}
