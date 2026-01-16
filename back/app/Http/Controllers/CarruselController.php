<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;

class CarruselController extends Controller
{
    public function crearcarrusel(Request $request){
        $request->validate([
            'titulo' => 'nullable|string',
            'fecha' => 'required|date',
            'visible' => 'boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $carrusel = new Carrusel;
        $carrusel->titulo = $request->input('titulo');
        $carrusel->fecha = $request->input('fecha');
        $carrusel->visible = $request->boolean('visible');
        $carrusel->save();
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgPath = $img->storeAs('carrusel/' . $carrusel->id, $img->getClientOriginalName(), 'public');
            $carrusel->img = $imgPath;
        }
        $carrusel->save(); // actualizar con paths de archivos
        return response()->json(['success' => true, 'mensaje' => 'Popup creado correctamente']);
    }
    public function micarrusel() {
        return Carrusel::all()->map(function($carrusel) {
            $carrusel->img_url = $carrusel->img ? asset('storage/' . $carrusel->img) : null;
            return $carrusel;
        });
    }
    public function eliminarcarrusel(Request $request){
        $carrusel = Carrusel::find($request->datos['id']);
        if (!$carrusel) {
            return response()->json(['message' => 'Ventana no encontrada'], 404);
        }
        if ($carrusel->img_url && \Storage::exists($carrusel->img_url)) {
            \Storage::delete($carrusel->img_url);
        }
        $carrusel->delete();
        return response()->json(['message' => 'Ventana eliminada y archivos borrados']);
    }
    public function cambiarEstadocarrusel(Request $request){
        $carrusel = Carrusel::find($request->id);
        if (!$carrusel) {
            return response()->json(['message' => 'Ventana no encontrada'], 404);
        }
        $carrusel->visible = $request->visible ? 1 : 0;
        $carrusel->save();
        return response()->json(['message' => 'Estado actualizado']);
    }
}
