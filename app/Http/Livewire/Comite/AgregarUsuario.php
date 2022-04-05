<?php

namespace App\Http\Livewire\Comite;

use Livewire\Component;
use App\Models\User;

class AgregarUsuario extends Component
{
    public $search;
    public $comite;

    // Función que permite obtener el comité al que deseamos ingresar el integrante
    public function mount($comite){
        $this->comite = $comite;
    }
    
    // Función que permite renderizar las busquedas para integrar un usuario a un comité
    // sin necesidad de recargar la página
    public function render()
    {
        $Usuarios = User::where('SiglasUsuario','like','%'.$this->search.'%')->paginate(5);
        return view('livewire.comite.agregar-usuario',compact('Usuarios'))->layout('layouts.plantilla');
    }
}
