<?php

namespace App\Http\Controllers;

use App\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{

    public function listAll(){
      $autores = Autor::with('libros')->get();
      $exist = $autores->isEmpty();
      return response()->json($exist? ["message" => "No hay autores registrados"]:$autores,
          $exist? 404 : 200);
    }

    public function read(Int $id){
      $autor = Autor::with('libros')->find($id);
      $exist = $autor == null;
      return response()->json($exist? ["message" => "No hay autor con ese ID"]:$autor,
          $exist? 404 : 200);
    }

    public function create(Request $request){
      $json = $request->json();
      $autor = Autor::firstOrFail()->where(
          [
              'nombre' => $json->get('nombre'),
              'nacionalidad' => $json->get('nacionalidad'),
          ]
      );
      if($autor->exists()){
        return response()->json(["message" => "Ya existe ese autor"], 409);
      }
      $request->validate([
          'nombre' => "string|required",
          'nacionalidad' => "string|required",
          'biografia' => "string"
      ]);
      $autor = new Autor();
      $autor->nombre = $json->get('nombre');
      $autor->nacionalidad = $json->get('nacionalidad');
      $autor->biografia = $json->get('biografia');
      $autor->save();
      return response()->json(["message" => "Autor registrado con exito"], 200);
    }

  public function update(Int $id, Request $request){
    $autor = Autor::find($id);
    if($autor == null){
      return response()->json(["message" => "No hay autor con ese ID"], 404);
    }
    $json = $request->json();
    $request->validate([
        'nombre' => "string|required",
        'nacionalidad' => "string|required",
        'biografia' => "string"
    ]);
    $autor->nombre = $json->get('nombre');
    $autor->nacionalidad = $json->get('nacionalidad');
    $autor->biografia = $json->get('biografia');
    $autor->save();
    return response()->json(["message" => "Autor actualizado con exito"], 200);
  }

  public function delete(Int $id){
    $autor = Autor::find($id);
    if($autor == null){
      return response()->json(["message" => "No hay autor con ese ID"], 404);
    }
    $autor->delete();
    return response()->json(["message" => "Autor eliminado con exito"], 200);
  }
}
