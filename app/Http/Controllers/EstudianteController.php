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

            // Validate that the codigo doesn't already exist
            $existingEstudiante = Estudiante::where('codigo', $request->codigo)->first();
            if ($existingEstudiante && $existingEstudiante->codigo == $estudiante->codigo) {
                // If the codigo already exists for another Estudiante, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El codigo ya existe para otro estudiante'], 400);
            }

            // Validate that the email doesn't already exist    
            $existingEstudiante = Estudiante::where('email', $request->email)->first();
            if ($existingEstudiante && $existingEstudiante->email == $estudiante->email) {
                // If the email already exists for another Estudiante, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El email ya existe para otro estudiante'], 400);
            }

            // Nombre del programa
            $nombrePrograma = $request->programa;
            // Consultar Id programa
            $programa = Programa::where('nombre', $nombrePrograma)->first();
            if ($programa) {
                $estudiante->programa_id = $programa->id;
                $estudiante->save();
                return response()->json(['estado' => 'ok']);
            } else {
                return response()->json(['estado' => 'error', 'msg' => 'No existe el programa']);
            }
        } catch (Exception $e) {
            return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($codigo)
    {
        $estudiante = Estudiante::where('codigo', $codigo)->first();

        if ($estudiante) {
            $estudiante->programa = $estudiante->programa;
            return response()->json(['estado' => 'ok', 'data' => $estudiante]);
        } else {
            // Handle case where no matching Estudiante is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Estudiante no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo)
    {
        // Find the Estudiante instance by codigo
        $estudiante = Estudiante::where('codigo', $codigo)->first();

        if ($estudiante) {
            // Validate that the codigo doesn't already exist
            $existingEstudiante = Estudiante::where('codigo', $request->codigo)->first();
            if ($existingEstudiante && $existingEstudiante->codigo !== $estudiante->codigo) {
                // If the codigo already exists for another Estudiante, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El codigo ya existe para otro estudiante'], 400);
            }

            // Validate that the email doesn't already exist
            $existingEstudiante = Estudiante::where('email', $request->email)->first();
            if ($existingEstudiante && $existingEstudiante->email !== $estudiante->email) {
                // If the email already exists for another Estudiante, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El email ya existe para otro estudiante'], 400);
            }
            // Validate if programan exists
            if (!Programa::find($request->programa_id)) {
                return response()->json(['estado' => 'error', 'mensaje' => 'No existe el programa'], 400);
            }

            // Update the Estudiante attributes
            try {
                $estudiante->update($request->all());
                return response()->json(['estado' => 'ok', 'mensaje' => 'Estudiante actualizado correctamente']);
            } catch (Exception $e) {
                return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
            }
        } else {
            // Handle case where no matching Estudiante is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Estudiante no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigo)
    {
        // Find the Estudiante instance by codigo
        $estudiante = Estudiante::where('codigo', $codigo)->first();

        if ($estudiante) {
            // Delete the Estudiante
            $estudiante->delete();

            return response()->json(['estado' => 'ok', 'mensaje' => 'Estudiante eliminado correctamente']);
        } else {
            // Handle case where no matching Estudiante is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Estudiante no encontrado'], 404);
        }
    }
}
