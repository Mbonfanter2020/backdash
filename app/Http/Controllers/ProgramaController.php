<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Programa;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        try {
            $programa = Programa::all();
            return response()->json(['estado' => 'ok', 'data' => $programa]);
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
            if($programa){
                $programa->save();
                return response()->json(['estado' => 'ok']);
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

            // Update the Estudiante attributes
            try {
                $programa->update($request->all());
                return response()->json(['estado' => 'ok', 'mensaje' => 'Programa actualizado correctamente']);
            } catch (Exception $e) {
                return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
            }
        } else {
            // Handle case where no matching Estudiante is found
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
