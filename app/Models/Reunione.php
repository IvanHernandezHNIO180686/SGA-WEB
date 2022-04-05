<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunione extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las auditoria y los reuniones
    //esto sirve para entablar la relación a nivel de eloquent
    public function Auditoria()
    {
        return $this->belongsTo('App\Models\Auditoria');
    }

    //Función que permite entablar la relación uno a muchos (1-N) entre los tipos de sesion 
    //y los reuniones esto sirve para entablar la relación a nivel de eloquent
    public function tipoSesione()
    {
        return $this->belongsTo('App\Models\TipoSesione');
    }

    //Función que permite entablar la relación uno a muchos (1-1) entre los acuerdos
    //y los reuniones esto sirve para entablar la relación a nivel de eloquent
    public function Acuerdo()
    {
        return $this->hasOne('App\Models\Acuerdo');
    }

    //Función que permite entablar la relación uno a muchos (1-N) entre los estatus
    //y los reuniones esto sirve para entablar la relación a nivel de eloquent
    public function Estatu()
    {
        return $this->belongsTo('App\Models\Estatu');
    }

    //Función que permite entablar la relación uno a uno (1-1) entre las asistencias
    //y los reuniones esto sirve para entablar la relación a nivel de eloquent
    public function Asistencia()
    {
        return $this->hasOne('App\Models\Asistencia');
    }
}
