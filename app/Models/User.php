<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'SiglasUsuario',
        'Nombres',
        'ApellidoPaterno',
        'ApellidoMaterno',
        'Puesto',
        'role_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //Función que permite entablar la relación uno a muchos (1-N) entre el rol
    //y el usuario esto sirve para entablar la relación a nivel de eloquent
    public function Role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    //Función que permite entablar la relación muchos a muchos (M-M) entre los usuarios y los comites
    //esto sirve para entablar la relación a nivel de eloquent
    public function Comites()
    {
        return $this->belongsToMany('App\Models\Comite');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */

    // Funcion que permite crear una relación entre el modelo de usuario y el modelo de 
    // reseteo de contraseña
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
