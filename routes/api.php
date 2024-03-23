<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

// Rutas estudiantes.
Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::post('/estudiantes', [EstudianteController::class, 'store']);
Route::put('/estudiantes', [EstudianteController::class, 'store']);
Route::delete('/estudiantes', [EstudianteController::class, 'store']);
