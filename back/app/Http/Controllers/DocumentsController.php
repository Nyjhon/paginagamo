<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\documents;
use Carbon\Carbon;

class DocumentsController extends Controller
{
    public function misdocumentos(){
        return documents::with([
            'folder.parent.parent',
            'folder.category'
        ])
        ->orderBy('fecha', 'desc')
        ->get()
        ->map(function ($document) {
            $document->archivo_url = $document->archivo ? asset('storage/documentos/' . $document->archivo) : null;
            $document->ruta = $document->folder?->fullPath() ?? null;
            return $document;
        });
    }
    public function creardocumento(Request $request){

        $fechaConHora = Carbon::parse($request->fecha)
        ->setTimeFromTimeString(now()->format('H:i:s'));
        $documents = new documents;
        $documents->titulo = $request->titulo;
        $documents->contenido = $request->contenido;
        $documents->fecha = $fechaConHora;
        $documents->folders_id = $request->folders_id;
        $documents->id_user = auth()->id();
        $documents->visible = $request->boolean('visible');

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');

            if ($archivo->isValid()) {
                // Obtener año y mes actual
                $anio = now()->format('Y'); // ej. "2025"
                $mes = now()->format('m');  // ej. "07"
                // Ruta de almacenamiento física: documentos/2025/07
                $ruta = "documentos/{$anio}/{$mes}";
                // Guardar archivo en esa ruta, dentro de 'public'
                $rutaArchivoNuevo = $archivo->storeAs($ruta, $archivo->getClientOriginalName(), 'public');
                // Guardar solo la parte año/mes/nombre.pdf en la base de datos
                $documents->archivo = "{$anio}/{$mes}/" . $archivo->getClientOriginalName();
            }
        }
        $documents->save();
        return response()->json($documents);
    }
    public function cambiarestado($id, Request $request){
        $documento = documents::findOrFail($id);
        $documento->visible = $request->input('visible') ? 1 : 0;
        $documento->save();

        return response()->json(['message' => 'Estado actualizado correctamente']);
    }
    public function editardocumento(Request $request, $id){
        $documento = documents::findOrFail($id);
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            if ($archivo->isValid()) {
                if ($documento->archivo && \Storage::disk('public')->exists('documentos/' . $documento->archivo)) {
                    \Storage::disk('public')->delete('documentos/' . $documento->archivo);
                }
                $anio = now()->format('Y');
                $mes = now()->format('m');
                $ruta = "documentos/{$anio}/{$mes}";
                $rutaArchivoNuevo = $archivo->storeAs($ruta, $archivo->getClientOriginalName(), 'public');
                $documento->archivo = "{$anio}/{$mes}/" . $archivo->getClientOriginalName();
            }
        }
        $documento->titulo = $request->titulo;
        $documento->contenido = $request->contenido;
        if ($request->folders_id !== null) {
            $documento->folders_id = $request->folders_id;
        }
        $documento->save();
        return response()->json(['message' => 'Documento actualizado correctamente.']);
    }
    public function verdocumento($id){
        $documento = Documents::findOrFail($id);
        if (!$documento->archivo) {
            abort(404, 'Archivo no encontrado');
        }
        $path = storage_path('app/public/documentos/' . $documento->archivo);
        if (!file_exists($path)) {
            abort(404, 'El archivo no existe en el servidor');
        }
        // Puedes usar file() para mostrar el PDF en el navegador
        return response()->file($path);
        // O download() si quieres que se descargue automáticamente:
        // return response()->download($path);
    }


}

