<?php

namespace App\Http\Livewire\Comite;

use Livewire\Component;
use App\Models\Comite;

class BuscarComite extends Component
{
    public $search;
    public function render()
    // Función que permite renderizar las busquedas del comité sin necesidad de recargar la página
    {
        $busqueda = strtoupper($this->search);
        $Comites = Comite::where('SiglasComite','like','%'.$busqueda.'%')->paginate(5);
        return view('livewire.comite.buscar-comite',compact('Comites'))->layout('layouts.plantilla');
    }
}
