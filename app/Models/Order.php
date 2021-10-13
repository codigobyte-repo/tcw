<?php

namespace App\Models;

use App\Mail\RejectPost;
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
    const CERRADO = 6;
    const RECHAZADO = 7;

    /* Relacion uno a muchos inversa*/
    public function users(){
        return $this->belongsTo(User::class);
    } 
    
     //Relacion uno a uno
     public function rejecte(){
        return $this->hasOne(RejectPost::class);
    }

    //Cree esta funcion para buscar al usuario por el id y asi mostrarlo en la vista \views\livewire\admin\proveedores\pagos.blade.php
    public static function searchUser($userId)
    {
        $usuario = User::find($userId);
        return ($usuario);

    }

}
