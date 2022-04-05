<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acuerdo extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las reuniones y los acuerdos
    //esto sirve para entablar la relación a nivel de eloquent
    public function Reunione()
    {
        return $this->belongsTo('App\Models\Reunione');
    }
    //Función que permite entablar la relación uno a uno (1-1) entre las archivos y los acuerdos
    //esto sirve para entablar la relación a nivel de eloquent
    public function Archivos()
    {
        return $this->hasOne('App\Models\Archivo');
    }
}
