<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Programa;
use App\Models\Estudiante;
use App\Models\Universidad;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $programas = Programa::all();
            foreach ($programas as $programa) {
                $programa['universidad'] = $programa->universidad;
            }
            return response()->json(['estado' => 'ok', 'data' => $programas]);
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
            $programa = new Programa();
            $programa->id = $request->id;
            $programa->nombre = $request->nombre;
            $programa->universidad_id = $request->universidad_id;
            
            // Validate that the codigo doesn't already exist
            $existingPrograma = Programa::where('id', $request->id)->first();
            if ($existingPrograma && $existingPrograma->id == $programa->id) {
                // If the codigo already exists for another programa, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El codigo ya existe para otro programa'], 400);
            }
            

            // Nombre de la universidad
            $nombreuniversidad = $request->universidad;
            // Consultar Id programa
            $universidad = Universidad::where('nombre', $nombreuniversidad)->first();

            if($universidad){
                $programa->save();
                return response()->json(['estado' => 'ok']);
            }else{
                return response()->json(['estado' => 'Error']);
            }
        } catch (Exception $e) {
            return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programa = Programa::where('id', $id)->first();

        if ($programa) {
            $programa->universidad = $programa->universidad;
            return response()->json(['estado' => 'ok', 'data' => $programa]);
        } else {
            // Handle case where no matching Programa is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Programa no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programa = Programa::where('id', $id)->first();

        if ($programa) {
            // Validate that the codigo doesn't already exist
            $existingPrograma = Programa::where('id', $request->id)->first();
            if ($existingPrograma && $existingPrograma->codigo !== $existingPrograma->codigo) {
                // If the codigo already exists for another Estudiante, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El id ya existe para otro Programa'], 400);
            }

            // Validate if universidad exists
            if (!Universidad::find($request->universidad_id)) {
                return response()->json(['estado' => 'error', 'mensaje' => 'No existe la universidad'], 400);
            }

            // Update the programa attributes
            try {
                $programa->update($request->all());
                return response()->json(['estado' => 'ok', 'mensaje' => 'Programa actualizado correctamente']);
            } catch (Exception $e) {
                return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
            }
        } else {
            // Handle case where no matching programa is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Programa no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programa = Programa::where('id', $id)->first();
        if ($programa) {

            //$dato = $programa->estudiantes;
            $estudiante_programaID = Estudiante::where('programa_id', $id)->first();
            
            if($estudiante_programaID) {
                return response()->json(['estado' => 'error', 'mensaje' => 'El programa tiene estudiantes asociados'], 404);
            }else{
                try {
                    // Delete the Programa
                    $programa->delete();
                    return response()->json(['estado' => 'ok', 'mensaje' => 'Programa eliminado correctamente']);
                } catch (Exception $e) {
                    return response()->json(['estado' => 'Error', 'mensaje' => 'Error Delete',$e]);
                }
            }
            
        } else {
            // Handle case where no matching Programa is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Programa no encontrado'], 404);
        }
    }
}
