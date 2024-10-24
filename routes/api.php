<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\TareaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/materias', [MateriaController::class, 'index']);
Route::post('/materias', [MateriaController::class,'store']);

Route::post('/clases', [ClaseController::class, 'store']);

Route::apiResource('/cursos', CursoController::class);

Route::apiResource('/tareas', TareaController::class);