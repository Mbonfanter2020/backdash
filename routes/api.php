<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\UniversidadController;

// Rutas estudiantes.
Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::get('/estudiantes/{codigo}', [EstudianteController::class, 'show']);
Route::post('/estudiantes', [EstudianteController::class, 'store']);
Route::put('/estudiantes/{codigo}', [EstudianteController::class, 'update']);
Route::delete('/estudiantes/{codigo}', [EstudianteController::class, 'destroy']);

Route::get('/programas', [ProgramaController::class, 'index']);
Route::get('/programas/{codigo}', [ProgramaController::class, 'show']);
Route::post('/programas', [ProgramaController::class, 'store']);
Route::put('/programas/{codigo}', [ProgramaController::class, 'update']);
Route::delete('/programas/{codigo}', [ProgramaController::class, 'destroy']);

Route::get('/universidads', [UniversidadController::class, 'index']);
Route::get('/universidads/{codigo}', [UniversidadController::class, 'show']);
Route::post('/universidads', [UniversidadController::class, 'store']);
Route::put('/universidads/{codigo}', [UniversidadController::class, 'update']);
Route::delete('/universidads/{codigo}', [UniversidadController::class, 'destroy']);