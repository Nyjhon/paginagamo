<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function listaunits(){
        return Unit::orderBy('id','asc')->get();
    }
    public function crearunits(Request $request){
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:255',
        ]);
        $unit = new Unit;
        $unit->codigo = strtoupper($validatedData['codigo']);
        $unit->nombre = strtoupper($validatedData['nombre']);
        $unit->save(); // Guarda el registro en la base de datos

        return response()->json(['mensaje' => 'Unidad con éxito', 'data' => $unit], 201);
    }
    public function editardoc(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:255',
        ]);
        $unit = Unit::find($validatedData['id']);
        $unit->codigo = strtoupper($validatedData['codigo']);
        $unit->nombre = strtoupper($validatedData['nombre']);
        $unit->save(); // Guarda el registro en la base de datos

        return response()->json(['mensaje' => 'Unidad modificado con éxito', 'data' => $unit], 201);
    }
}
