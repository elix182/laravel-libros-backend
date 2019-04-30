<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $fillable = [
        'nombre',
        'nacionalidad',
        'biografia'
    ];

    public function libros(){
        return $this->belongsToMany('App\Libro','autores_libros');
    }
}
