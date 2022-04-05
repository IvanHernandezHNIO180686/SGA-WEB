<?php

namespace App\Http\Livewire\Reunion;

use Livewire\Component;
use App\Models\Reunione;

class BuscarReunion extends Component
{
    public $search;
    // Función que permite renderizar las busquedas de las reuniones sin necesidad de recargar la página
    public function render()
    {
        $busqueda = strtoupper($this->search);
        $Reuniones = Reunione::where('NombreReunion','like','%'.$busqueda.'%')->paginate(5);
        return view('livewire.reunion.buscar-reunion',compact('Reuniones'))->layout('layouts.plantilla');
    }
}
