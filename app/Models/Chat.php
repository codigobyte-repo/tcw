<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'message',
        'chat_id',
        'friend_id'
    ];

    /* Retornamos un usuario de un chat que envía mensaje */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_sent');
    }

}
