<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'chat_id',
        'friend_id'
    ];

    /* Obtenemos el usuario que envía el chat */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
