<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacione extends Model
{
    use HasFactory;

    //Función que permite entablar la relación uno a muchos (1-N) entre las tipo de notificaciones y 
    // las notificaciones esto sirve para entablar la relación a nivel de eloquent
    public function tipoNotificacione()
    {
        return $this->belongsTo(TipoNotificacione::class, 'tipo_notificacione_id');
    }
}
