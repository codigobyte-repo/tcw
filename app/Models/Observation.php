<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'post_id'];

    /* Relacion uno a uno inversa*/
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
