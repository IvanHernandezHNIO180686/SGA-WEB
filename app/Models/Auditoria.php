<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las tipo auditoria y los auditoria
    //esto sirve para entablar la relación a nivel de eloquent
    public function tipoAuditoria()
    {
        return $this->belongsTo(TipoAuditoria::class, 'tipo_auditoria_id');
    }

    //Función que permite entablar la relación uno a uno (1-1) entre las comite y los auditoria
    //esto sirve para entablar la relación a nivel de eloquent
    public function Comite()
    {
        return $this->hasOne('App\Models\Comite');
    }

    //Función que permite entablar la relación uno a muchos (1-N) entre las reuniones y los auditoria
    //esto sirve para entablar la relación a nivel de eloquent
    public function reuniones()
    {
        return $this->hasMany('App\Models\Reunione');
    }
}
