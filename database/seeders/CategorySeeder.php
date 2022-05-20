<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=Category::factory(10)->create();
        foreach($categories as $item){
            Image::factory(1)->create([
                'imageable_id'=>$item->id,
                'imageable_type'=>Category::class
            ]);
        }
    }
}
