<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $fillable = [
        'curso', 	
        'promocion', 	
        'bachillerato'
    ];
}
