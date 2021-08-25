<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;
    const PROHIBIDO = 3;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Transforma la url en el SLUG */
    public function getRouteKeyName()
    {
        return "slug";
    }

    /* Relacion uno a muchos inversa*/
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    /* Relacion uno a muchos */
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    /* Relacion uno a muchos inversa*/
    public function user(){
        return $this->belongsTo(User::class);
    }

    /* Relacion uno a muchos inversa*/
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /* Relacion muchos a muchos*/
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /* Relacion muchos a muchos*/
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    /* Realcion uno a uno polimorfica */
    public function images()
    {
        /* Como primer parametro le pasamos Image... y el segundo es la funcion de Image.php */
        return $this->morphMany(Image::class, 'imageable');
    }
}
