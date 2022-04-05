<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAuditoria extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las tipo auditoria y los auditoria
    //esto sirve para entablar la relación a nivel de eloquent
    public function Auditorias()
    {
        return $this->hasMany(Auditoria::class, 'id');
    }
}
