<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* Relacion uno a muchos */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /* Relacion muchos a muchos */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
