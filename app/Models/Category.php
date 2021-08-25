<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'icon'];

    /* Transforma la url en el SLUG */
    public function getRouteKeyName()
    {
        return "slug";
    }

    /* Relacion uno a muchos */
    public function posts(){
        return $this->hasManyThrough(Post::class, Subcategory::class);
    }

    /* Relacion uno a muchos */
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    /* Relacion muchos a muchos */
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }
}
