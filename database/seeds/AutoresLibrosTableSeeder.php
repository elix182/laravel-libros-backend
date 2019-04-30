<?php

use App\Autor;
use App\Libro;
use Illuminate\Database\Seeder;

class AutoresLibrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Autor::all()->each(function(Autor $autor){
          if($autor != null) {
            $autor->libros()
                ->sync(Libro::inRandomOrder()->first());
          }
        });
    }
}
