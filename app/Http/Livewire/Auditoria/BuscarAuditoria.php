<?php

namespace App\Http\Livewire\Auditoria;

use Livewire\Component;
use App\Models\Auditoria;

class BuscarAuditoria extends Component
{
    public $search;
    public function render()
    // Función que permite renderizar las busquedas de las auditorías sin necesidad de recargar la página
    {
        $busqueda = strtoupper($this->search);
        $Auditorias = Auditoria::where('SiglasAuditoria','like','%'.$busqueda.'%')->paginate(5);
        return view('livewire.auditoria.buscar-auditoria',compact('Auditorias'))->layout('layouts.plantilla');
    }
}
