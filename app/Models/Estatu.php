<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{
    use HasFactory;

    //Función que permite entablar la relación muchos a uno (N-1) entre las reuniones y los auditorias
    //esto sirve para entablar la relación a nivel de eloquent
    public function Reuniones()
    {
        return $this->hasMany('App\Models\Reunione');
    }
}
