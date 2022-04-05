<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre el rol
    //y el usuario esto sirve para entablar la relación a nivel de eloquent
    public function User()
    {
        return $this->hasMany('App\Models\User');
    }
}
