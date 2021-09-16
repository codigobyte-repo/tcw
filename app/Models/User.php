<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /* Relacion uno a muchos */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /* Relacion uno a muchos */
    public function orders(){
        return $this->hasMany(Order::class);
    }

    /* Relacion uno a muchos */
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    //Relacion uno a uno
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    //Relacion uno a uno
    public function information(){
        return $this->hasOne(Information::class);
    }

    //Relacion uno a uno
    public function validate(){
        return $this->hasOne(Validate::class);
    }

    //Contamos los posts
    public function getPostsCountAttribute(){
        return $this->posts()->count();
    }
    
}
