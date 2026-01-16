<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function crearcategory(Request $request){
        $request->validate([
            'titulo' => 'nullable|string',
            'fecha' => 'required|date',
            'visible' => 'boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $category = new Category;
        $category->titulo = $request->input('titulo');
        $category->fecha = $request->input('fecha');
        $category->visible = $request->boolean('visible');
        $category->save();
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgPath = $img->storeAs('category/' . $category->id, $img->getClientOriginalName(), 'public');
            $category->img = $imgPath;
        }
        $category->save();
        return response()->json(['success' => true, 'mensaje' => 'Categoria creado correctamente']);
    }
    public function micategory() {
        return Category::all()->map(function($category) {
            $category->img_url = $category->img ? asset('storage/' . $category->img) : null;
            return $category;
        });
    }
    public function eliminarcategory(Request $request){
        $category = Category::find($request->datos['id']);
        if (!$category) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }
        if ($category->img_url && \Storage::exists($category->img_url)) {
            \Storage::delete($category->img_url);
        }
        $category->delete();
        return response()->json(['message' => 'Categoria eliminada']);
    }
    public function cambiarEstadocategory(Request $request){
        $category = Category::find($request->id);
        if (!$category) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }
        $category->visible = $request->visible ? 1 : 0;
        $category->save();
        return response()->json(['message' => 'Estado actualizado']);
    }
}
