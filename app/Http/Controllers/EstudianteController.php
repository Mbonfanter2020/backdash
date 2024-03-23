<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Programa;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $estudiantes = Estudiante::all();
            foreach ($estudiantes as $estudiante) {
                $estudiante['programa'] = $estudiante->programa;
            }
            return response()->json(['estado' => 'ok', 'data' => $estudiantes]);
        } catch (\Throwable $th) {
            return response()->json(['estado' => 'error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        try {
            $estudiante = new Estudiante();
            $estudiante->codigo = $request->codigo;
            $estudiante->nombre = $request->nombre;
            $estudiante->email = $request->email;
            $estudiante->fechaN = $request->fechaN;
            // Nombre del programa
            $nombrePrograma = $request->programa;
            // Consultar Id programa
            $programa = Programa::where('nombre', $nombrePrograma)->first();
            if($programa) {
                $estudiante->programa_id = $programa->id;
                $estudiante->save();
                return response()->json(['estado' => 'ok']);
            }
            else {
            return response()->json(['estado' => 'error', 'msg' => 'No existe el programa']);
            }
        } catch (Exception $e) {
            return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
