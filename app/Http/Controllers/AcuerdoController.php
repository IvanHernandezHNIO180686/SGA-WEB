<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarAcuerdo;
use App\Models\Acuerdo;
use App\Models\User;
use App\Models\Archivo;
use App\Models\Auditoria;
use App\Models\Comite;
use App\Models\Logo;
use App\Models\Notificacione;
use App\Models\Reunione;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use PDF;

class AcuerdoController extends Controller
{
    // Esta función permite obtener las nuevas notificaciones pertenecientes al usuario que tiene una
    // sesión activa con el rol de profesor.
    protected function optenerNotificaciones()
    {
        $usuario = User::find(auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)->where('Estado', '=', 'SIN LEER')->count();
        return $notificaciones;
    }
    // Función que permite entrar a la vista principal de los acuerdos
    public function index()
    {
        return view('Admin.acuerdo.indexAcuerdo');
    }

    // Función para crear un archivo pdf de un acuerdo creado previamente.
    public function pdf(Acuerdo $acuerdo)
    {
        $logo = Logo::find(2);
        $pdf = PDF::loadView('Admin.acuerdo.pdfAcuerdo', ['acuerdo' => $acuerdo], ['logo' => $logo]);
        return $pdf->download('Acuerdo_' . $acuerdo->NumeroAcuerdo . '.pdf');
    }

    // Función que permite visualizar un acuerdo en específico, el dato de entrada es un objeto
    // de tipo Acuerdo el cual es pasado directamente a la vista de consultar específica.
    public function show(Acuerdo $acuerdo)
    {
        $archivos = Archivo::all();
        return view('Admin.Acuerdo.showAcuerdo', compact('acuerdo', 'archivos'));
    }

    //Función para crear un nuevo acuerdo, envía un dato de salida de tipo carbon que permite
    //recolectar la fecha y hora actual en la que esta creando el acuerdo y la envia a la vista de
    //crear Acuerdo
    public function create()
    {
        $now = Carbon::now();
        return view('Admin.acuerdo.crearAcuerdo', compact('now'));
    }

    //Funció que resibe los datos de la vista de crearAcuerdo dentro de un objeto de tipo Request
    //al terminar el registro el sistema redirecciona a la vista principal de los acuerdos.
    public function store(Request $request)
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->SiglasUsuario == $request->Responsable) {
                $notificacion = new Notificacione();
                $notificacion->NombreNotificacion = 'RESPONSABLE DE ACUERDO';
                $notificacion->Accion = 'USTED ES EL RESPONSABLE DEL ACUERDO: ' . $request->NumeroAcuerdo;
                $notificacion->id_usuario = $user['id'];
                $notificacion->Estado = 'SIN LEER';
                $notificacion->tipo_notificacione_id = 3;
                $notificacion->save();
            }
        }

        $datosAcuerdo = request()->except('_token');
        Acuerdo::insert($datosAcuerdo);



        $id = 0;
        $acuerdos = Acuerdo::all();
        foreach ($acuerdos as $acuerdo) {
            if ($acuerdo->NumeroAcuerdo = $datosAcuerdo['NumeroAcuerdo']) {
                $id = $acuerdo->id;
            }
        }
        $acuerdo = Acuerdo::find($id);
        $now = Carbon::now();

        $fechaActual = $now->format('Y-m-d');


        $date = $acuerdo->created_at;
        $FechaCreacion = Carbon::createFromDate($date);
        $fechaActual = Carbon::now();
        $diasTranscurridos = $fechaActual->diffInDays($FechaCreacion);

        $dia = $acuerdo->FechaCumplimiento;
        $fechaCumplimiento = Carbon::createFromDate($dia);
        $diasFaltantes = $fechaCumplimiento->diffInDays($fechaActual);
        $diasFaltantes = $diasFaltantes + 1;

        return view('Admin.acuerdo.reporteAcuerdo', compact('acuerdo', 'diasTranscurridos', 'diasFaltantes'));
    }


    // Función para recabar los datos de un acuerdo a editar, esto datos son recabados por una
    // un objeto de tipo Acuerdo para posteriormente enviarlos a la pestaña de editar donde
    // se mostrarán los datos.
    public function edit(Acuerdo $acuerdo)
    {
        $now = Carbon::now();
        $reunion = Reunione::find($acuerdo->reunione_id);
        $auditoria = Auditoria::find($reunion->auditoria_id);
        $id_comite = $auditoria->comite->id;
        $comite = Comite::find($id_comite);
        $users = $comite->users;
        return view('Admin.acuerdo.editAcuerdo', compact('now', 'acuerdo', 'users'));
    }

    //Función que ayuda a editar los datos que fueron cambiados en la vista de editar Acuerdo
    //estos datos son recolectados en un objeto de tipo Acuerdo para luego ser actualizados en la
    //base de datos, posterior a la acción se redirecciona a la vista principal de los acuerdos.
    public function update(Request $request, Acuerdo $acuerdo)
    {
        $validated = $request->validate([
            'FechaCumplimiento' => "after_or_equal:$acuerdo->FechaCumplimiento"
        ]);

        $acuerdo->NumeroAcuerdo = $request->NumeroAcuerdo;
        $acuerdo->Responsable = $request->Responsable;
        $acuerdo->FechaCumplimiento = $request->FechaCumplimiento;
        $acuerdo->Observaciones = $request->Observaciones;
        $acuerdo->reunione_id = $request->reunione_id;
        $acuerdo->updated_at = $request->updated_at;

        $acuerdo->save();

        return redirect()->route('Acuerdo.index')->with('editar', 'ok');
    }

    //Función que permite eliminar un acuerdo específico recolectando su identificador en
    //un objeto de tipo Acuerdo posterior a la acción se redirecciona a la vista principal
    //de los acuerdos.
    public function destroy(Acuerdo $acuerdo)
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->SiglasUsuario == $acuerdo->Responsable) {
                $notificacion = new Notificacione();
                $notificacion->NombreNotificacion = 'ACUERDO ELIMINADO';
                $notificacion->Accion = 'EL ACUERDO: ' . $acuerdo->NumeroAcuerdo . ' HA SIDO ELIMINADO';
                $notificacion->id_usuario = $user->id;
                $notificacion->Estado = 'SIN LEER';
                $notificacion->tipo_notificacione_id = 3;

                $notificacion->save();
            }
        }
        $acuerdo->delete();


        return redirect()->route('Acuerdo.index')->with('eliminar', 'ok');
    }

    // Función que selecciona los acuerdos pertenecientes al
    // usuario que tiene una sesión iniciada, los cuales serean mostrados en la vista de acuerdos del
    // profesor.
    public function acuerdoProf()
    {
        $usuario = User::find(Auth()->user()->id);
        $acuerdos = Acuerdo::paginate(5);
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.Acuerdos.indexAcuerdosP', compact('usuario', 'acuerdos', 'notificaciones'));
    }
}
