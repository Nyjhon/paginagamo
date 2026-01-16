<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popup;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function crearventana(Request $request){
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'visible' => 'boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
        ]);
        $popup = new Popup;
        $popup->titulo = $request->input('titulo');
        $popup->descripcion = $request->input('descripcion');
        $popup->fecha = $request->input('fecha');
        $popup->visible = $request->boolean('visible');
        $popup->save();
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgPath = $img->storeAs('popup/' . $popup->id, $img->getClientOriginalName(), 'public');
            $popup->img = $imgPath;
        }
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            if ($archivo->isValid()) {
                $rutaArchivoNuevo = $archivo->storeAs('popup/'.$popup->id,$archivo->getClientOriginalName(), 'public');
                $popup->archivo = $rutaArchivoNuevo;
            }
        }
        $popup->save(); // actualizar con paths de archivos
        return response()->json(['success' => true, 'mensaje' => 'Popup creado correctamente']);
    }
    public function misventanas() {
        return Popup::all()->map(function($popup) {
            $popup->img_url = $popup->img ? asset('storage/' . $popup->img) : null;
            $popup->archivo_url = $popup->archivo ? asset('storage/' . $popup->archivo) : null;
            return $popup;
        });
    }
    public function eliminarventana(Request $request){
        $ventana = Popup::find($request->datos['id']);

        if (!$ventana) {
            return response()->json(['message' => 'Ventana no encontrada'], 404);
        }
        if ($ventana->img_url && \Storage::exists($ventana->img_url)) {
            \Storage::delete($ventana->img_url);
        }
        if ($ventana->archivo_url && \Storage::exists($ventana->archivo_url)) {
            \Storage::delete($ventana->archivo_url);
        }
        $ventana->delete();
        return response()->json(['message' => 'Ventana eliminada y archivos borrados']);
    }
    public function cambiarEstadoVentana(Request $request){
        $ventana = Popup::find($request->id);
        if (!$ventana) {
            return response()->json(['message' => 'Ventana no encontrada'], 404);
        }
        $ventana->visible = $request->visible ? 1 : 0;
        $ventana->save();
        return response()->json(['message' => 'Estado actualizado']);
    }

}
