<?php

namespace App\Http\Livewire\Acuerdo;

use Livewire\Component;
use App\Models\Acuerdo;
use App\Models\Comite;
use App\Models\Reunione;
use App\Models\Auditoria;

class CrearAcuerdo extends Component
{
    public $selectedAuditoria = null;
    public $SiglasAuditoria = null, $nombreComite = null, $Comites = null, $nombreAcuerdo = null;

    // Funcion que permite la renderización de la pagina de crear acuerdo
    public function render()
    {
        $Reuniones = Reunione::all();
        return view('livewire.acuerdo.crear-acuerdo', compact('Reuniones'));
    }

    //Funcion que permite llenar las siglas del la auditoria, el nombre del comite y el nombre del acuerdo
    // de manera automatica.
    public function updatedselectedAuditoria($reunion_id){
        $cont = 0;
        $Acuerdos = Acuerdo::all();
        foreach ($Acuerdos as $acuerdo) {
            $cont = $cont + 1;
        }

        $reunion = Reunione::find($reunion_id);
        $auditoria = Auditoria::find($reunion->auditoria_id);
        $siglasAuditoria = $reunion->auditoria->SiglasAuditoria;

        if($reunion->tipo_sesione_id == 1){
            $sesion = 'SO';
            $cantidad = $auditoria->comite->SesionesOrdinarias;
        }elseif($reunion->tipo_sesione_id == 2){
            $sesion = 'SE';
            $cantidad = $auditoria->comite->SesionesExtraordinarias;
        }

        if($cantidad < 10){
            $SesionesCantidad = $sesion.'0'.$cantidad;
        }elseif($cantidad >= 10){
            $SesionesCantidad=$sesion.$cantidad;
        }

        if($cont < 10){
            $Auditorias = 'A'.'0'.$cont;
        }elseif($cont >= 10){
            $Auditorias = 'A'.$cont;
        }


        $this->nombreAcuerdo = $siglasAuditoria.'-'.$SesionesCantidad.'-'.$Auditorias;

        $auditoria_id = $auditoria->id;

        $this->nombreComite = $auditoria->comite->NombreComite;
        $this->SiglasAuditoria = $auditoria->SiglasAuditoria;

        $this->Comites = Comite::select('users.SiglasUsuario', 'users.Nombres','users.ApellidoPaterno','users.ApellidoMaterno')
        ->join('comite_user', 'comites.id', '=', 'comite_user.comite_id')
        ->join('users', 'comite_user.user_id', '=', 'users.id')
        ->where('auditoria_id',$auditoria_id)->get();

    }
}
