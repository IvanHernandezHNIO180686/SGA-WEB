<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\User;
use Livewire\Component;

class BuscarSolicitud extends Component
{

    public $search;
    // Función que permite renderizar las busquedas de las solicitudes sin necesidad de recargar la página
    public function render()
    {
        $busqueda = strtoupper($this->search);
        $Users = User::where('SiglasUsuario','like','%'.$busqueda.'%')->where('role_id','=',3)->paginate(5);
        return view('livewire.solicitud.buscar-solicitud',compact('Users'))->layout('layouts.plantilla');

    }
}
