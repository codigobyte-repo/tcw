<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    const PENDIENTE = 1;
    const PROCESO = 2;
    const RECIBIDO = 3;
    const FINALIZADO = 4;
    const ANULADO = 5;

    /* Relacion uno a muchos inversa*/
    public function users(){
        return $this->belongsTo(User::class);
    }    

}
