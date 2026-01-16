<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::get('ventanas',[\App\Http\Controllers\PopupController::class,'misventanas']);
Route::get('carrusel',[\App\Http\Controllers\CarruselController::class,'micarrusel']);
Route::get('app',[\App\Http\Controllers\AppController::class,'miapp']);
Route::get('noticias',[\App\Http\Controllers\NoticiaController::class,'misnoticias']);
Route::get('categorydoc',[\App\Http\Controllers\CategoryController::class,'micategory']);
Route::get('documentospagina/{id}',[\App\Http\Controllers\FoldersController::class,'documentospagina']);
Route::get('documentospaginafolders/{id}',[\App\Http\Controllers\FoldersController::class,'documentospaginafolders']);
Route::get('/ver-documento/{id}', [App\Http\Controllers\DocumentsController::class, 'verdocumento']);

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::resource('/user',\App\Http\Controllers\UserController::class);
    Route::post('/crearusuario',[\App\Http\Controllers\UserController::class,'crearusuario']);
    Route::post('/updatePassword',[\App\Http\Controllers\UserController::class,'updatePassword']);
    Route::post('/cambiopassword/{user}',[\App\Http\Controllers\UserController::class,'cambiopassword']);
    Route::post('/editarusuario',[\App\Http\Controllers\UserController::class,'editarusuario']);

    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']);

    Route::post('/deleteduser',[\App\Http\Controllers\UserController::class,'deleteduser']);

    Route::get('/listausers',[\App\Http\Controllers\UserController::class,'listausers']);

    
    Route::get('/listaunits',[\App\Http\Controllers\UnitController::class,'listaunits']);
    Route::post('/crearunits',[\App\Http\Controllers\UnitController::class,'crearunits']);
    Route::post('/editardoc',[\App\Http\Controllers\UnitController::class,'editardoc']);
    //ventanas emergentes
    Route::get('misventanas',[\App\Http\Controllers\PopupController::class,'misventanas']);
    Route::post('crearventana',[\App\Http\Controllers\PopupController::class,'crearventana']);
    Route::post('eliminarventana',[\App\Http\Controllers\PopupController::class,'eliminarventana']);
    Route::post('cambiarEstadoVentana',[\App\Http\Controllers\PopupController::class,'cambiarEstadoVentana']);
    //Carrusel
    Route::get('micarrusel',[\App\Http\Controllers\CarruselController::class,'micarrusel']);
    Route::post('crearcarrusel',[\App\Http\Controllers\CarruselController::class,'crearcarrusel']);
    Route::post('eliminarcarrusel',[\App\Http\Controllers\CarruselController::class,'eliminarcarrusel']);
    Route::post('cambiarEstadocarrusel',[\App\Http\Controllers\CarruselController::class,'cambiarEstadocarrusel']);
    //App y servicios
    Route::get('miapp',[\App\Http\Controllers\AppController::class,'miapp']);
    Route::post('crearapp',[\App\Http\Controllers\AppController::class,'crearapp']);
    Route::post('eliminarapp',[\App\Http\Controllers\AppController::class,'eliminarapp']);
    Route::post('cambiarestadoapp',[\App\Http\Controllers\AppController::class,'cambiarestadoapp']);
    Route::post('resaltarapp',[\App\Http\Controllers\AppController::class,'resaltarapp']);
    //Noticia
    Route::get('misnoticias',[\App\Http\Controllers\NoticiaController::class,'misnoticias']);
    Route::post('crearnoticia',[\App\Http\Controllers\NoticiaController::class,'crearnoticia']);
    Route::post('eliminarnoticia',[\App\Http\Controllers\NoticiaController::class,'eliminarnoticia']);
    Route::post('cambiarEstadoNoticia',[\App\Http\Controllers\NoticiaController::class,'cambiarEstadoNoticia']);
    //Categoria
    Route::get('micategory',[\App\Http\Controllers\CategoryController::class,'micategory']);
    Route::post('crearcategory',[\App\Http\Controllers\CategoryController::class,'crearcategory']);
    Route::post('eliminarcategory',[\App\Http\Controllers\CategoryController::class,'eliminarcategory']);
    Route::post('cambiarEstadocategory',[\App\Http\Controllers\CategoryController::class,'cambiarEstadocategory']);
    //Carpetas o folders
    Route::get('/folders/arbol',[\App\Http\Controllers\FoldersController::class,'misfolder']);
    Route::get('folders/categoria/{categoryId}',[\App\Http\Controllers\FoldersController::class,'getFoldersByCategory']);
    Route::post('folders/crear',[\App\Http\Controllers\FoldersController::class,'crear']);
    Route::get('folders/eliminar/{id}',[\App\Http\Controllers\FoldersController::class,'eliminar']);
    //Documentos
    Route::get('/misdocumentos',[\App\Http\Controllers\DocumentsController::class,'misdocumentos']);
    Route::post('/documents/crear',[\App\Http\Controllers\DocumentsController::class,'creardocumento']);
    Route::post('/documents/cambiarestado/{id}',[\App\Http\Controllers\DocumentsController::class,'cambiarestado']);
    Route::post('/documents/editar/{id}',[\App\Http\Controllers\DocumentsController::class,'editardocumento']);
});
