<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion'];

    //una etiqueya puede ser para muchos posts

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    public function nombre() : Attribute {
        return Attribute::make(
            get : fn($v)=>ucfirst($v),
            set : fn($v)=>ucfirst($v)
        );
    }

    public function descripcion() : Attribute {
        return Attribute::make(
            get : fn($v)=>ucfirst($v),
            set : fn($v)=>ucfirst($v)
        );
    }
}
