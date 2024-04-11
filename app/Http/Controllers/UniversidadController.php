<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Exception;
use App\Models\Universidad;
use Illuminate\Http\Request;

class UniversidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $universidad = Universidad::all();
            return response()->json(['estado' => 'ok', 'data' => $universidad]);
        } catch (\Throwable $th) {
            return response()->json(['estado' => 'error']);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $universidad = new Universidad();
            $universidad->id = $request->id;
            $universidad->nombre = $request->nombre;
            if($universidad){
                $universidad->save();
                return response()->json(['estado' => 'ok']);
            }
        } catch (\Throwable $th) {
            return response()->json(['estado' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $universidad = Universidad::where('id', $id)->first();

        if ($universidad) {
            return response()->json(['estado' => 'ok', 'data' => $universidad]);
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
        $universidad = Universidad::where('id', $id)->first();

        if ($universidad) {
            // Validate that the codigo doesn't already exist
            $existingUniversidad = Universidad::where('id', $request->id)->first();
            if ($existingUniversidad && $existingUniversidad->codigo !== $existingUniversidad->codigo) {
                // If the codigo already exists for another universidad, return error message
                return response()->json(['estado' => 'error', 'mensaje' => 'El id ya existe para otra universidad'], 400);
            }

            // Update the programa attributes
            try {
                $universidad->update($request->all());
                return response()->json(['estado' => 'ok', 'mensaje' => 'Universidad actualizada correctamente']);
            } catch (Exception $e) {
                return response()->json(['estado' => 'error', 'msg' => $e->getMessage()]);
            }
        } else {
            // Handle case where no matching programa is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Universidad no encontrada'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $universidad = Universidad::where('id', $id)->first();
        if ($universidad) {

            $programa_universidadID = Programa::where('universidad_id', $id)->first();
            
            if($programa_universidadID) {
                return response()->json(['estado' => 'error', 'mensaje' => 'La universidad tiene Programas asociados'], 404);
            }else{
                try {
                    // Delete the Programa
                    $universidad->delete();
                    return response()->json(['estado' => 'ok', 'mensaje' => 'Universidad eliminada correctamente']);
                } catch (Exception $e) {
                    return response()->json(['estado' => 'Error', 'mensaje' => 'Error Delete',$e]);
                }
            }
            
        } else {
            // Handle case where no matching Programa is found
            return response()->json(['estado' => 'error', 'mensaje' => 'Universidad no encontrada'], 404);
        }
    }
}
