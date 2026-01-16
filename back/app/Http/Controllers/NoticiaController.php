<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Imagenes;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function misnoticias(){
        $noticias = Noticia::with('imagenes')->orderBy('id','desc')->get();
        return response()->json($noticias);
    }
    public function crearnoticia(Request $request){
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'visible' => 'boolean',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096', // validación múltiple de imágenes
        ]);
        // Crear la noticia con datos básicos
        $noticia = new Noticia;
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $request->input('fecha');
        $noticia->visible = $request->boolean('visible');
        // Guardar sin archivo ni imágenes aún
        $noticia->save();
        // Subir imágenes si existen
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                if ($imagen->isValid()) {
                    $ruta = $imagen->store("noticias/imagenes/{$noticia->id}", 'public');
                    $noticia->imagenes()->create(['ruta' => $ruta]);
                }
            }
        }
        // Subir archivo si existe
        if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
            $archivo = $request->file('archivo');
            $rutaArchivoNuevo = $archivo->storeAs("noticias/pdf/{$noticia->id}", $archivo->getClientOriginalName(), 'public');
            $noticia->archivo = $rutaArchivoNuevo;
            $noticia->save(); // segunda vez porque ya tenemos la ruta
        }
        return response()->json([
            'success' => true,
            'mensaje' => 'Noticia creada correctamente'
        ]);
    }
    public function cambiarEstadoNoticia(Request $request){
        $noticia = Noticia::find($request->id);
        if (!$noticia) {
            return response()->json(['message' => 'Noticia no encontrada'], 404);
        }
        $noticia->visible = $request->visible ? 1 : 0;
        $noticia->save();
        return response()->json(['message' => 'Estado actualizado']);
    }
    public function eliminarnoticia(Request $request){
        $noticia = Noticia::with('imagenes')->find($request->datos['id']);
        if (!$noticia) {
            return response()->json(['message' => 'Noticia no encontrada'], 404);
        }
        // Eliminar imágenes físicas y registros en la base de datos
        foreach ($noticia->imagenes as $imagen) {
            if (\Storage::disk('public')->exists($imagen->ruta)) {
                \Storage::disk('public')->delete($imagen->ruta);
            }
            $imagen->delete(); // eliminar de la tabla
        }
        // Eliminar archivo PDF si existe
        if ($noticia->archivo && \Storage::disk('public')->exists($noticia->archivo)) {
            \Storage::disk('public')->delete($noticia->archivo);
        }
        // Eliminar la noticia
        $noticia->delete();
        return response()->json(['message' => 'Noticia y archivos eliminados correctamente']);
    }

}
