<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\folders;
use App\Models\Category;
use App\Models\documents;
use Illuminate\Support\Facades\Validator;

class FoldersController extends Controller
{
    public function getFoldersByCategory($categoryId){
        $carpetas = folders::with('childrenRecursive')
            ->where('category_id', $categoryId)
            ->whereNull('parent_id')
            ->orderBy('orden', 'asc')
            ->get();
        $result = [];
        $this->procesarJerarquia($carpetas, $result);

        return response()->json($result);
    }
    private function procesarJerarquia($folders, &$result, $prefijo = ''){
        foreach ($folders as $folder) {
            $result[] = [
                'id' => $folder->id,
                'nombre' => $prefijo . $folder->nombre
            ];

            if ($folder->childrenRecursive->isNotEmpty()) {
                $this->procesarJerarquia($folder->childrenRecursive, $result, $prefijo . '— ');
            }
        }
    }
    public function misfolder(){
        $folders = folders::with('childrenRecursive') // relación recursiva
            ->whereNull('parent_id')
            ->orderBy('orden', 'asc')
            ->get();

        return response()->json($folders);
    }
    public function documentospagina($id){
        // Si el ID pertenece a una categoría
        $categoria = Category::find($id);
        $folders = folders::with('childrenRecursive')
                ->where('category_id', $id)
                ->whereNull('parent_id')
                ->orderBy('orden', 'asc')
                ->get();
        return response()->json([
                'categoria' => $categoria,
                'folders' => $folders
        ]);
    }
    public function documentospaginafolders($id)
    {
        $folder = folders::with('childrenRecursive', 'parent')->find($id);

        if (!$folder) {
            return response()->json(['error' => 'Carpeta no encontrada'], 404);
        }

        $documentos = documents::with(['folder.category'])
            ->where('folders_id', $id)
            ->where('visible', true)
            ->orderBy('fecha','desc')
            ->get()
            ->map(function ($document) {
                $document->archivo_url = $document->archivo ? asset('storage/documentos/' . $document->archivo) : null;
                $document->ruta = $document->folder?->fullPath() ?? null;
                return $document;
            });

        return response()->json([
            'documentos' => $documentos,
            'folder' => $folder,
            'ruta' => $folder->fullPath2()
        ]);
    }


    public function crear(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'parent_id' => 'nullable|exists:folders,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }
        $folder = folders::create([
            'nombre' => $request->nombre,
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_id, // puede ser null
        ]);

        return response()->json([
            'message' => 'Carpeta creada correctamente',
            'folder' => $folder
        ], 201);
    }
    public function eliminar($id){
        $folder = folders::with(['children', 'documents'])->findOrFail($id);

        if ($folder->children->isNotEmpty() || $folder->documents->isNotEmpty()) {
            return response()->json([
                'error' => true,
                'message' => 'No se puede eliminar una carpeta que contiene subcarpetas o documentos.'
            ]);
        }

        $folder->delete();

        return response()->json([
            'error' => false,
            'message' => 'Carpeta eliminada correctamente.'
        ]);
    }

}
