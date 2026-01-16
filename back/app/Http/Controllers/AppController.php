<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class AppController extends Controller
{
    public function crearapp(Request $request){
        $request->validate([
            'titulo' => 'required|string',
            'url' => 'required|url',
            'fecha' => 'required|date',
            'visible' => 'boolean',
            'resaltar' => 'boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $app = new App;
        $app->titulo = $request->input('titulo');
        $app->url = $request->input('url');
        $app->fecha = $request->input('fecha');
        $app->visible = $request->boolean('visible');
        $app->resaltar = $request->boolean('resaltar');
        $app->save();
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgPath = $img->storeAs('apps/' . $app->id, $img->getClientOriginalName(), 'public');
            $app->img = $imgPath;
        }
        $app->save(); // actualizar con paths de archivos
        return response()->json(['success' => true, 'mensaje' => 'App creado correctamente']);
    }
    public function miapp() {
        return App::all()->map(function($app) {
            $app->img_url = $app->img ? asset('storage/' . $app->img) : null;
            return $app;
        });
    }
    public function eliminarapp(Request $request){
        $app = App::find($request->datos['id']);
        if (!$app) {
            return response()->json(['message' => 'App no encontrada'], 404);
        }
        if ($app->img_url && \Storage::exists($app->img_url)) {
            \Storage::delete($app->img_url);
        }
        $app->delete();
        return response()->json(['message' => 'App eliminada y archivos borrados']);
    }
    public function cambiarestadoapp(Request $request){
        $app = App::find($request->id);
        if (!$app) {
            return response()->json(['message' => 'App no encontrada'], 404);
        }
        $app->visible = $request->visible ? 1 : 0;
        $app->save();
        return response()->json(['message' => 'Estado actualizado']);
    }
    public function resaltarapp(Request $request){
        $app = App::find($request->id);
        if (!$app) {
            return response()->json(['message' => 'App no encontrada'], 404);
        }
        $app->resaltar = $request->resaltar ? 1 : 0;
        $app->save();
        return response()->json(['message' => 'Estado actualizado']);
    }
}
