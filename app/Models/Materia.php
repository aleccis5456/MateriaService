<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['name'];

    public function tareas(){
        return $this->hasMany(Tarea::class);
    }
}
