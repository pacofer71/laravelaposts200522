<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags=Tag::pluck('id')->toArray();
        $posts=Post::factory(100)->create();
        foreach($posts as $item){
            Image::factory(1)->create([
                'imageable_id'=>$item->id,
                'imageable_type'=>Post::class
            ]);
            //le un numero random de tags asignamos varias tags
            $cant=random_int(1, count($tags)-1);
            $item->tags()->attach(
                array_slice($tags, 0,$cant)
            );

        }
    }
}
