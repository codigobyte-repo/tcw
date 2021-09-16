<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectePost extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order(){
        return $this->belongsTo(Post::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

}
