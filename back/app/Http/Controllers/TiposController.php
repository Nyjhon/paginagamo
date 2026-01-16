<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;

class TiposController extends Controller
{
    public function listatipos(){
        return Tipos::orderBy('id', 'asc')->get();
    }
    public function creardoc(Request $request){
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:255',
        ]);

        $tipo = new Tipos;
        $tipo->codigo = strtoupper($validatedData['codigo']);
        $tipo->nombre = strtoupper($validatedData['nombre']);
        $tipo->save(); // Guarda el registro en la base de datos

        return response()->json(['mensaje' => 'Tipo de documento creado con éxito', 'data' => $tipo], 201);
    }
    public function editardoc(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:255',
        ]);

        $tipo = Tipos::find($validatedData['id']);
        $tipo->codigo = strtoupper($validatedData['codigo']);
        $tipo->nombre = strtoupper($validatedData['nombre']);
        $tipo->save(); // Guarda el registro en la base de datos

        return response()->json(['mensaje' => 'Tipo de documento editado con éxito', 'data' => $tipo], 201);
    }
}
