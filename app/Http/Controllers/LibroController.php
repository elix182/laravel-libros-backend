<?php

namespace App\Http\Controllers;

use App\Autor;
use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
  public function listAll(){
    //$libros = Libro::all();
    $libros = Libro::with('autores')->get();
    $exist = $libros->isEmpty();
    return response()->json($exist? ["message" => "No hay libros registrados"]:$libros,
        $exist? 404 : 200);
  }

  public function read(Int $id){
    $libro = Libro::with('autores')->find($id);
    $exist = $libro == null;
    return response()->json($exist? ["message" => "No hay libro con ese ID"]:$libro,
        $exist? 404 : 200);
  }

  public function create(Request $request){
    $json = $request->json();
    $libro = Libro::firstOrFail()->where(
        [
            'titulo' => $json->get('titulo'),
        ]
    );
    if($libro->exists()){
      return response()->json(["message" => "Ya existe ese libro"], 409);
    }
    $request->validate(
        [
            'titulo'=> "string|required",
            'fecha_publicacion'=> "string|required",
            'tipo'=> "string|required",
            'descripcion'=> "string|required"
        ]);
    $libro = new Libro();
    $libro->titulo = $json->get('titulo');
    $libro->tipo = $json->get('tipo');
    $libro->descripcion = $json->get('descripcion');
    $libro->fecha_publicacion = date_create_from_format("YYYY-MM-dd",$json->get('fecha_publicacion'));
    $autores = $json->get('autores');
    if($autores){
      foreach ($autores as $autorId){
        $autor = Autor::find($autorId);
        $libro->autores()->sync($autor);
      }
    }
    $libro->save();
    return response()->json(["message" => "Autor registrado con exito"], 200);
  }

  public function update(Int $id, Request $request){
    $libro = Libro::find($id);
    if($libro == null){
      return response()->json(["message" => "No hay libro con ese ID"], 404);
    }
    $json = $request->json();
    $request->validate(
        [
            'titulo'=> "string|required",
            'fecha_publicacion'=> "string|required",
            'tipo'=> "string|required",
            'descripcion'=> "string|required"
        ]);
    $libro->titulo = $json->get('titulo');
    $libro->tipo = $json->get('tipo');
    $libro->descripcion = $json->get('descripcion');
    $libro->fecha_publicacion = date_create_from_format("YYYY-MM-dd",$json->get('fecha_publicacion'));
    $autores = $json->get('autores');
    if($autores){
      $libro->autores()->detach();
      foreach ($autores as $autorId){
        $autor = Autor::find($autorId);
        $libro->autores()->sync($autor);
      }
    }
    $libro->save();
    return response()->json(["message" => "Autor actualizado con exito"], 200);
  }

  public function delete(Int $id){
    $libro = Libro::find($id);
    if($libro == null){
      return response()->json(["message" => "No hay libro con ese ID"], 404);
    }
    $libro->delete();
    return response()->json(["message" => "Libro eliminado con exito"], 200);
  }

  public function fetchAutoresLibro(Int $id) {
    $libro = Libro::find($id);

    if(!$libro) {
      return response()->json(['mensaje' => 'No se encontró libro con ese ID'], 404);
    }

    if($libro->autores->isEmpty()) {
      return response()->json(['mensaje' => 'No se encontraron libros asociados al autor especificado'], 404);
    }

    return response()->json($libro->autores, 200);
  }
}
