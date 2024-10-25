<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\CursoAlumnoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::apiResource('/materias', MateriaController::class);

Route::apiResource('/clases', ClaseController::class);

Route::apiResource('/cursoAlumno', CursoAlumnoController::class);

Route::apiResource('/cursos', CursoController::class);

Route::apiResource('/tareas', TareaController::class);