<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use App\Models\User;

class BuscarUsuario extends Component
{
    public $search;

    // Función que permite renderizar las busquedas de los usuarios sin necesidad de recargar la página
    public function render()
    {
        $busqueda = strtoupper($this->search);
        $Users = User::where('SiglasUsuario','like','%'.$busqueda.'%')->paginate(5);
        return view('livewire.usuario.buscar-usuario',compact('Users'))->layout('layouts.plantilla');
    }
}
