<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSesione extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre los tipos de sesion 
    //y los reuniones esto sirve para entablar la relación a nivel de eloquent
    public function Reuniones()
    {
        return $this->hasMany('App\Models\Reunione');
    }
}
