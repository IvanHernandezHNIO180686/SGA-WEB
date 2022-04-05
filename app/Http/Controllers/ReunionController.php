<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarReunion;
use App\Models\Acuerdo;
use App\Models\Asistencia;
use App\Models\Auditoria;
use App\Models\Reunione;
use App\Models\TipoSesione;
use App\Models\Comite;
use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ReunionController extends Controller
{
    // Función que permité obtener la fecha actual.
    protected function fechaActual()
    {
        $now = Carbon::now();
        $fechaActual = $now->format('Y-m-d');
        return $fechaActual;
    }

    // Función que permité ver la página de inicio de las reuniones desde el apartado de administrador
    public function index()
    {
        $Reuniones = Reunione::paginate(5);
        return view('Admin.Reunion.indexReunion', compact('Reuniones'));
    }

    // Función que muestra el formulario de registro de una nueva reunión.
    public function create()
    {
        $Auditorias = Auditoria::all();
        $TipoSesiones = TipoSesione::all();

        return view('Admin.Reunion.createReunion', compact('TipoSesiones'), compact('Auditorias'));
    }

    // Función que recopila la información dada en el formulario de registro de una nueva reunión
    // para posteriormente registrarla en la BD.
    public function store(Request $request)
    {
        $reuniones = Reunione::all();
        $coincidencia = 0;
        $count = 0;

        // Bucle que realiza la validación de duplicación del nombre
        foreach ($reuniones as $reunion) {
            if ($reunion->NombreReunion == $request->NombreReunion) {
                $coincidencia = 1;
            }
        }

        $auditoria = Auditoria::find($request->auditoria_id);
        $comiteAsignado = $auditoria->Comite;
        $integrantes = $comiteAsignado->users;

        // Bucle que realiza la validación si existen integrantes en el comité a cargo de la reunión
        // o no.
        foreach ($integrantes as $integrante) {
            $count = $count + 1;
        }


        if ($count == 0) {
            // Si no hay integrantes pertenecientes al comité se emite el error de integrantes
            // inexistentes
            $Auditorias = Auditoria::all();
            $TipoSesiones = TipoSesione::all();
            return redirect()->route('Reunion.create', compact('Auditorias', 'TipoSesiones'))->with('errorSinIntegrantes', 'ok');
        } elseif ($coincidencia == 1) {
            // Error de validación de nombre de reunión
            $Auditorias = Auditoria::all();
            $TipoSesiones = TipoSesione::all();
            return redirect()->route('Reunion.create', compact('Auditorias', 'TipoSesiones'))->with('errorDupNombre', 'ok');
        } else {
            // Si las validaciones se cumplieron en este apartado se crea la reunión

            $cantidad = 0;
            $reunion = new Reunione();
            $reunion->NombreReunion = $request->NombreReunion;
            $reunion->auditoria_id = $request->auditoria_id;
            $reunion->FechaReunion = $request->FechaReunion;
            $reunion->Observaciones = $request->Observaciones;
            $reunion->tipo_sesione_id = $request->tipo_sesione_id;
            $reunion->estatu_id = $request->estatu_id;

            $now = Carbon::now();

            $reunion->created_at = $now->format('Y-m-d') . ' ' . $now->format('H:i');
            $reunion->updated_at = $now->format('Y-m-d') . ' ' . $now->format('H:i');
            $reunion->save();



            $id_comite = $auditoria->comite->id;

            // Estructura condicional que identifica que tipo de sesión es la reunión
            // para posteriormente aumentar el numero de sesiónes ordinarias o extraordinarias 
            // que ha tenido el comité
            if ($request->tipo_sesione_id == 1) {
                $comite = Comite::find($id_comite);
                $cantidad = $comite->SesionesOrdinarias;
                $comite->SesionesOrdinarias = $cantidad + 1;
                $comite->save();
            } else {
                $comite = Comite::find($id_comite);
                $cantidad = $comite->SesionesExtraordinarias;
                $comite->SesionesExtraordinarias = $cantidad + 1;
                $comite->save();
            }

            // Bucle que permite notificar a cada uno de los integrantes del comité que tendrán una 
            // reunión.
            foreach ($integrantes as $integrante) {
                $notificacion = new Notificacione();
                $notificacion->NombreNotificacion = 'NUEVA REUNIÓN';
                $notificacion->Accion = 'USTED HA SIDO CONVOCADO A LA REUNIÓN: ' . $request->NombreReunion;
                $notificacion->id_usuario = $integrante->id;
                $notificacion->Estado = 'SIN LEER';
                $notificacion->tipo_notificacione_id = 4;

                $notificacion->save();
            }


            return redirect()->route('Reunion.index');
        }
    }

    // Función que permite visualizar los datos de una reunión en específico, esta parte utiliza la 
    // función de Fecha Actual.
    public function show(Reunione $reunion)
    {
        $estado = $reunion->estatu_id;
        $fechaActual = $this->fechaActual();
        $participantesSI = Asistencia::where('reunione_id', $reunion->id)->where('Estatus', 'Si asistire')->get();
        $participantesNO = Asistencia::where('reunione_id', $reunion->id)->where('Estatus', 'No asistire')->get();
        $usuarios = User::all();
        return view('Admin.Reunion.showReunion', compact('usuarios', 'reunion', 'fechaActual', 'estado', 'participantesSI', 'participantesNO'));
    }

    // Función que muestra el formulario de edición de una reunión.
    public function edit(Reunione $reunion)
    {
        $Auditorias = Auditoria::all();
        $TipoSesiones = TipoSesione::all();

        return view('Admin.Reunion.editReunion', compact('reunion', 'Auditorias', 'TipoSesiones'));
    }

    // Función que permité guardar los datos modificados de una reunión
    public function update(Request $request, Reunione $reunion)
    {
        // Validación del formulario de edición
        $validated = $request->validate([
            'NombreReunion' => 'required',
            'FechaReunion' => "after_or_equal:$reunion->FechaReunion"
        ]);
        $reunion->NombreReunion = $request->NombreReunion;
        $reunion->auditoria_id = $request->auditoria_id;
        $reunion->FechaReunion = $request->FechaReunion;
        $reunion->Observaciones = $request->Observaciones;
        $reunion->tipo_sesione_id = $request->tipo_sesione_id;

        $now = Carbon::now();

        $reunion->updated_at = $now->format('Y-m-d') . ' ' . $now->format('H:i');
        $reunion->save();
        return redirect()->route('Reunion.index')->with('editar', 'ok');
    }

    // Función que permite eliminar una reunión en específico
    public function destroy(Reunione $reunion)
    {
        $reunion->delete();
        return redirect()->route('Reunion.index')->with('eliminar', 'ok');
    }

    // Función que muestra la interfaz para crear un acuerdo desde el apartado de reuniones
    public function acuerdo(Reunione $reunion)
    {
        $now = Carbon::now();
        $cont = 0;
        $Acuerdos = Acuerdo::all();

        // Dentro de este bucle se obtiene el número de acuerdo que le corresponde
        foreach ($Acuerdos as $acuerdo) {
            $cont = $cont + 1;
        }


        $auditoria = Auditoria::find($reunion->auditoria_id);
        $siglasAuditoria = $reunion->auditoria->SiglasAuditoria;

        // Con esta estructura condicional se obtiene si es una sesión ordinaria o extraordinaria.
        if ($reunion->tipo_sesione_id == 1) {
            $sesion = 'SO';
            $cantidad = $auditoria->comite->SesionesOrdinarias;
        } elseif ($reunion->tipo_sesione_id == 2) {
            $sesion = 'SE';
            $cantidad = $auditoria->comite->SesionesExtraordinarias;
        }

        // Estructura que nos ayuda a identificar si la cantidad de sesiónes tenidas es menor o mayor 
        // 10 en caso de ser menor se concatenara con un 0 a su izquierda.
        if ($cantidad < 10) {
            $SesionesCantidad = $sesion . '0' . $cantidad;
        } elseif ($cantidad >= 10) {
            $SesionesCantidad = $sesion . $cantidad;
        }

        // Estructura que nos ayuda a identificar si la cantidad de acuerdos es menor o mayor 
        // 10 en caso de ser menor se concatenara con un A0 a su izquierda y una A en caso de 
        // ser mayor a 10.
        if ($cont < 10) {
            $Auditorias = 'A' . '0' . $cont;
        } elseif ($cont >= 10) {
            $Auditorias = 'A' . $cont;
        }

        // Concatenación de los datos obtenidos en los bucles y estructuras para crear el numero 
        // de acuerdo
        $numeroAcuerdo = $siglasAuditoria . '-' . $SesionesCantidad . '-' . $Auditorias;
        $comite = $auditoria->comite;
        $usuarios = $comite->users;
        return view('Admin.Reunion.AcuerdoReunion', compact('reunion', 'numeroAcuerdo', 'comite', 'usuarios', 'now'));
    }

    // Función que recopila todos los datos del formulario de creación de un acuerdo desde el 
    // apartado de reuniones.
    public function addAcuerdo(Request $request)
    {
        $datosAcuerdo = request()->except('_token', 'NombreReunion');
        Acuerdo::insert($datosAcuerdo);
        return redirect()->route('Reunion.index');
    }

    // Función que permite cambiar el estadus de la reunión en
    // 2.- Reunión iniciada (estatu = 2)
    // 3.- Reunión finalizada (estatu = 3)
    public function estatus(Request $request, Reunione $reunion)
    {
        $now = Carbon::now();
        $coincidencia = 0;
        $reunion->estatu_id = $request->estatu_id;
        if ($request->estatu_id == 2) {
            // 2.- Reunión iniciada (estatu = 2)
            $reunion->HoraInicio =  $now->format('H:i');
            $asistencia = new Asistencia();
            $asistencia->reunione_id = $reunion->id;
            $asistencia->Profesor = '1';
            $asistencia->Estatus = 'Asistencia';
            $asistencia->save();
        } elseif ($request->estatu_id == 3) {
            // 3.- Reunión finalizada (estatu = 3)
            $auditoria = Auditoria::find($reunion->auditoria_id);
            $comite = Comite::find($auditoria->comite->id);
            $usuarios = $comite->users;
            
            // Bucle que identifica si a los integrantes que no asistieron a la reunión y les pone falta
            foreach ($usuarios as $usuario) {

                $asistencias = Asistencia::where("reunione_id", "=", $reunion->id)->where("Profesor", "=", $usuario->id)->count();
                if ($asistencias == 0) {
                    $asistencia = new Asistencia();
                    $asistencia->reunione_id = $reunion->id;
                    $asistencia->Profesor = $usuario->id;
                    $asistencia->Estatus = 'Falta';
                    $asistencia->save();
                }
            }
            $reunion->HoraTermino =  $now->format('H:i');
        }

        $reunion->save();
        $estado = $reunion->estatu_id;
        $fechaActual = $this->fechaActual();
        $participantesSI = Asistencia::where('reunione_id', $reunion->id)->where('Estatus', 'Si asistire')->get();
        $participantesNO = Asistencia::where('reunione_id', $reunion->id)->where('Estatus', 'No asistire')->get();
        $usuarios = User::all();
        return view('Admin.Reunion.showReunion', compact('reunion', 'fechaActual', 'estado', 'usuarios', 'participantesSI', 'participantesNO'));
    }

    // Función que permite ver a un profesor con sesión activa las reuniones que ha tenido 
    public function verReunionIndividual()
    {
        $usuario = User::find(Auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)
            ->where('Estado', '=', 'Sin Leer')->count();


        $resultados = Reunione::join("auditorias", "auditorias.id", "=", "reuniones.auditoria_id")
            ->join("comites", "comites.id", "=", "auditorias.id")
            ->join("comite_user", "comite_user.comite_id", "=", "comites.id")
            ->join("estatus", "estatus.id", "=", "reuniones.estatu_id")
            ->join("tipo_sesiones", "tipo_sesiones.id", "=", "reuniones.tipo_sesione_id")
            ->where("comite_user.user_id", "=", $usuario->id)
            ->get();


        return view('Profesores.reuniones.verReunionIndvidual', compact('resultados', 'notificaciones'));
    }
}
