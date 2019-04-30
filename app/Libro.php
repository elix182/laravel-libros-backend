<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'titulo',
        'fecha_publicacion',
        'tipo',
        'descripcion'
    ];

    public function autores(){
        return $this->belongsToMany('App\Autor','autores_libros');
    }
}
