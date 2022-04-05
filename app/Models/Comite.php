<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las auditoria y los comite
    //esto sirve para entablar la relación a nivel de eloquent
    public function auditoria()
    {
        return $this->belongsTo('App\Models\Auditoria');
    }

    //Función que permite entablar la relación muchos a muchos (M-M) entre los usuarios y los comites
    //esto sirve para entablar la relación a nivel de eloquent
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
