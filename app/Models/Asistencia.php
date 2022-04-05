<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las asistencia y los reuniones
    //esto sirve para entablar la relación a nivel de eloquent
    public function Reunione()
    {
        return $this->belongsTo('App\Models\Reunione');
    }
}
