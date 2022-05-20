<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion'];

    //de una categoria hay muchos posts

    public function posts(){
        return $this->hasMany(Post::class);
    }

    //una categoria tiene una imagen

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function nombre() : Attribute{
        return  Attribute::make(
            get : fn($v) =>ucfirst($v),
            set : fn($v) =>ucfirst($v)
        );
    }
    public function contenido() : Attribute{
        return  Attribute::make(
            get : fn($v) =>ucfirst($v),
            set : fn($v) =>ucfirst($v)
        );
    }
}
