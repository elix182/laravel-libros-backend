<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', 'AuthController@login');
  Route::post('signup', 'AuthController@signup');

  Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
  });
});

Route::get("/autores", "AutorController@listAll")->middleware('auth:api');;
Route::get("/autores/{id}", "AutorController@read")->middleware('auth:api');;
Route::post("/autores", "AutorController@create")->middleware('auth:api');;
Route::put("/autores/{id}", "AutorController@update")->middleware('auth:api');;
Route::delete("/autores/{id}", "AutorController@delete")->middleware('auth:api');;

Route::get("/libros", "LibroController@listAll")->middleware('auth:api');;
Route::get("/libros/{id}", "LibroController@read")->middleware('auth:api');;
Route::post("/libros", "LibroController@create")->middleware('auth:api');;
Route::put("/libros/{id}", "LibroController@update")->middleware('auth:api');;
Route::delete("/libros/{id}", "LibroController@delete")->middleware('auth:api');;
Route::get("/libros/autores/{id}", "LibroController@fetchAutoresLibros")->middleware('auth:api');;