<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Post extends Model
{
    use HasFactory;

    protected $fillable=['titulo', 'contenido', 'category_id', 'user_id', 'estado'];

    //un post tiene una categoria
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Un post pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //un posts puede tener muchos tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Vamos con las imagenes un post tiene una imagen
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function titulo(): Attribute{
       return Attribute::make(
            set : fn($v)=>ucfirst($v),
            get : fn($v)=>ucfirst($v)
        );
    }

    public function contenido(): Attribute{
        return Attribute::make(
             set : fn($v)=>ucfirst($v),
             get : fn($v)=>ucfirst($v)
         );
     }
}
