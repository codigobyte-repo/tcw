<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'icon', 'category_id'];

    /* Transforma la url en el SLUG */
    public function getRouteKeyName()
    {
        return "slug";
    }

    /* Relacion categorías: Relacion uno a muchos inversa: De subcategoria a categoria*/ 
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /* Relacion muchos a muchos*/
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
