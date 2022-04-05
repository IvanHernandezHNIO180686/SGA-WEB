<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las archivos y los acuerdos
    //esto sirve para entablar la relación a nivel de eloquent
    public function Acuerdo()
    {
        return $this->belongsTo('App\Models\Acuerdo');
    }
}
