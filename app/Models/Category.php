<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $allowIcluded = ['posts', 'posts.user'];

     //relacion uno a muchos
     public function posts(){
        return $this->hasMany(Post::class);
    }

    public function scopeIncluded(Builder $query){

        if (empty($this->allowIcluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));

        $allowIcluded = collect($this->allowIcluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIcluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
}
