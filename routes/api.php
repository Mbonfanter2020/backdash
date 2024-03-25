<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProgramaController;

// Rutas estudiantes.
Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::post('/estudiantes', [EstudianteController::class, 'store']);
Route::put('/estudiantes', [EstudianteController::class, 'store']);
Route::delete('/estudiantes', [EstudianteController::class, 'store']);

Route::get('/programas', [ProgramaController::class, 'index']);
Route::post('/programas', [ProgramaController::class, 'store']);