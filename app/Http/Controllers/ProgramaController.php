<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Programa;
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
    public function show(Programa $programa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programa $programa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programa $programa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programa $programa)
    {
        //
    }
}
