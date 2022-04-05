<?php

namespace App\Http\Livewire\Acuerdo;

use Livewire\Component;
use App\Models\Acuerdo;

class ShowAcuerdo extends Component
{
    public $search;
    public function render()
    // Función que permite renderizar las busquedas del acuerdo sin necesidad de recargar la página
    {
        $busqueda = strtoupper($this->search);
        $Acuerdos = Acuerdo::where('NumeroAcuerdo','like','%'.$busqueda.'%')->paginate(5);
        return view('livewire.acuerdo.show-acuerdo',compact('Acuerdos'))->layout('layouts.plantilla');
    }
}
