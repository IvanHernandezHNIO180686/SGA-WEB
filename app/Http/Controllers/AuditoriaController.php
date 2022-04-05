<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarAuditoria;
use App\Models\Auditoria;
use App\Models\Notificacione;
use App\Models\TipoAuditoria;
use App\Models\User;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    // Función que permite visualizar la página principal de las auditorías desde el 
    // apartado del administrador
    public function index()
    {
        return view('Admin.Auditoria.indexAuditoria');
    }

    // Función que permité mostrar la interfaz para la creación de una auditoría
    public function create()
    {
        $tipoAuditoria = TipoAuditoria::all();
        return view('Admin.Auditoria.createAuditoria', compact('tipoAuditoria'));
    }

    // Función que permité registrar una auditoría nueva.
    public function store(Request $request)
    {
        $coincidencia = 0;
        $datosAuditoria = request()->except('_token');
        $auditorias = Auditoria::all();

        // Bucle que permité identificar si ya hay un registro con los datos de la nueva auditoría
        foreach ($auditorias as $auditoria) {
            if ($auditoria->SiglasAuditoria == $request->SiglasAuditoria) {
                $coincidencia = 1;
            }
        }

        // Estructura condicional que permité notificarle al usuario que ya existe una auditoría
        //  con esos datos o en caso contrarío registrar la auditoría y notificarle al usuario que fue creada.
        if ($coincidencia == 1) {
            $tipoAuditoria = TipoAuditoria::all();
            return redirect()->route('Auditoria.create', compact('tipoAuditoria'))->with('error', 'ok');
        } else {
            Auditoria::insert($datosAuditoria);
            return redirect()->route('Auditoria.index')->with('crear', 'ok');
        }
    }

    // Función que permité mostrar una auditoría en específico.
    public function show(Auditoria $auditoria)
    {
        return view('Auditoria.showAuditoria', compact('auditoria'));
    }

    // Función que permité mostrar una interfas que contiene un formulario de edición con los
    //  datos de una auditoría en específico.
    public function edit(Auditoria $auditoria)
    {
        $tipoAuditoria = TipoAuditoria::all();
        return view('Admin.Auditoria.editAuditoria', compact('auditoria'), compact('tipoAuditoria'));
    }

    // Función que recopila los datos del formulario de edición permitiento actualizar la auditoría.
    public function update(Request $request, Auditoria $auditoria)
    {
        // Validaciones del formulario de edición
        $validated = $request->validate([
            'SiglasAuditoria' => 'required|min:4|max:5',
            'Organismo' => 'required',
            'FechaAuditoria' => "after_or_equal:$auditoria->FechaAuditoria"
        ]);
        $auditoria->SiglasAuditoria = $request->SiglasAuditoria;
        $auditoria->Organismo = $request->Organismo;
        $auditoria->FechaAuditoria = $request->FechaAuditoria;
        $auditoria->Comentarios = $request->Comentarios;
        $auditoria->tipo_auditoria_id = $request->Tipo_Auditoria_id;

        $auditoria->save();

        return redirect()->route('Auditoria.index')->with('editar', 'ok');
    }

    // Función que permite eliminar una auditoría
    public function destroy(Auditoria $auditoria)
    {
        $auditoria->delete();
        return redirect()->route('Auditoria.index')->with('eliminar', 'ok');
    }

    // Función que permite visualizar la página principal de las auditorías
    // pertenecientes aun usuario que tenga una sesión activa desde el apartado del profesor
    public function misAuditorias()
    {
        $user = User::find(auth()->user()->id);
        $comites = $user->comites;
        $auditorias = Auditoria::all();
        $notificaciones = Notificacione::where('id_usuario', '=', $user->id)
            ->where('Estado', '=', 'Sin Leer')->count();
        return view('Profesores.Auditorias.indexAuditorias', compact('comites', 'auditorias', 'notificaciones'));
    }
}
