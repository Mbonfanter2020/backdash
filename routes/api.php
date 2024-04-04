<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProgramaController;

// Rutas estudiantes.
Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::get('/estudiantes/{codigo}', [EstudianteController::class, 'show']);
Route::post('/estudiantes', [EstudianteController::class, 'store']);
Route::put('/estudiantes/{codigo}', [EstudianteController::class, 'update']);
Route::delete('/estudiantes/{codigo}', [EstudianteController::class, 'destroy']);

Route::get('/programas', [ProgramaController::class, 'index']);
Route::post('/programas', [ProgramaController::class, 'store']);