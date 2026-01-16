<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class TiposUnitsController extends Controller
{
    public function asignarTipos(Request $request) {
        $request->validate([
            'unit_id' => 'required|integer|exists:units,id',
            'tipos' => 'array',
            'tipos.*' => 'integer|exists:tipos,id',
        ]);
    
        $unidad = Unit::find($request->unit_id); // Usamos 'unit_id' en lugar de 'unidad_id'
        if ($unidad) {
            $unidad->tipos()->sync($request->tipos); // Sincroniza tipos en la tabla pivot
            return response()->json(['message' => 'Tipos asignados con éxito']);
        }
    
        return response()->json(['message' => 'Unidad no encontrada'], 404);
    }
    
}
