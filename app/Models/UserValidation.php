<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserValidation extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    /* Realcion uno a uno polimorfica */
    public function images()
    {
        /* Como primer parametro le pasamos Image... y el segundo es la funcion de Image.php */
        return $this->morphMany(Image::class, 'imageable');
    }
}
