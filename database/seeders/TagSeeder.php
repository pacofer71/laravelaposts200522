<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags=[
            'Programación'=>'Relacionados con programación',
            'Miscelanea' =>'Etiquetas para posts inetiquetables',
            'Idiomas'=>'Relacionados con Idiomas',
            'Relax' => 'Relacionados con Relax',
            'Deporte'=>'Relacionados con Deportes'
        ];

        foreach($tags as $k=>$v){
            Tag::create([
                'nombre'=>$k,
                'descripcion'=>$v,

            ]);
        }
    }
}
