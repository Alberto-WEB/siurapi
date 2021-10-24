<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Post extends Model
{
    use HasFactory, ApiTrait;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $fillable = ['name', 'slug', 'extract', 'body', 'status', 'category_id', 'user_id'];

     //relacion uno a muchos inversa
     public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    //relacion uno a muchos poliformica con el modelo image
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
