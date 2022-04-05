<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarComite;
use App\Models\Auditoria;
use App\Models\Comite;
use App\Models\Reunione;
use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;



class ComiteController extends Controller
{
    // Función que permite obtener las notificaciones de un usuario de tipo profesor que cuente
    // con una sesión activa.
    protected function optenerNotificaciones()
    {
        $usuario = User::find(auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)
            ->where('Estado', '=', 'Sin Leer')->count();
        return $notificaciones;
    }

    // Función que permite ver al administrador todos los comités registrados en el sistema.
    public function index()
    {
        $comites = Comite::paginate(5);
        return view('Admin.comite.indexComite', compact('comites'));
    }

    // Función que muestra el formulario para registrar un nuevo comité.
    public function create()
    {
        $auditorias = Auditoria::all();
        $now = Carbon::now();
        return view('Admin.Comite.createComite', compact('auditorias'), compact('now'));
    }

    // Función que permite visualizar un comité en especifico.
    public function show(Comite $comite)
    {
        return view('Admin.Comite.showComite', compact('comite'));
    }

    // Función que permite agregar un usuario a un comité en específico.
    public function agregarUsuario(Request $request, Comite $comite)
    {
        $buscarComite = Comite::find($comite->id);

        // Consulta en la base de datos que identifica si el usuario ya se encuentra enlazado al 
        // comité.
        $comite = Comite::join('comite_user', 'comite_user.comite_id', '=', 'comites.id')
            ->join('users', 'comite_user.user_id', '=', 'users.id')->where('comite_user.user_id', '=', $request->user_id)
            ->where('comite_user.comite_id', '=', $buscarComite->id)->count();

        // Estructura condicional que en caso de que el usuario ya se encuentre
        // enlazado al comité notifica un error y en caso contrario enlaza al usuario con
        // el comité creando una notificación.
        if ($comite > 0) {

            return redirect()->route('Comite.asignar', $buscarComite->id)->with('error', 'ok');
        } else {

            $buscarComite->Users()->attach($request->user_id);
            $notificacion = new Notificacione();
            $notificacion->NombreNotificacion = 'ASIGNACIÓN DE A COMITÉ';
            $notificacion->Accion = 'HA SIDO AGREGADO AL COMITÉ QUE LLAMADO ' . $buscarComite->NombreComite;
            $notificacion->id_usuario = $request->user_id;
            $notificacion->Estado = 'SIN LEER';
            $notificacion->tipo_notificacione_id = 1;

            $notificacion->save();

            return redirect()->route('Comite.asignar', $buscarComite->id)->with('asignar', 'ok');
        }
    }

    // Función que permite visualizar la interfaz para agregar usuarios al comité seleccionado.
    public function asignar(Comite $comite)
    {
        return view('Admin.Comite.asignarUsuario', compact('comite'));
    }

    // Función que permite mostrar el formulario de edición para un comité.
    public function edit(Comite $comite)
    {
        $Auditorias = Auditoria::all();
        $now = Carbon::now();
        return view('Admin.Comite.editComite', compact('comite'), compact('Auditorias'), compact('now'));
    }

    // Función que recopila los datos del formulario de edición permitiento modificar un comité.
    public function update(EditarComite $request, Comite $comite)
    {
        // Estructura condicional donde en caso de que se eliminaran integrantes del comité 
        // se les notificará.
        if ($request->integrantes == true) {
            foreach ($request->integrantes as $integrante) {
                $usuario = User::find($integrante);
                $notificacion = new Notificacione();
                $notificacion->NombreNotificacion = 'ELIMINADO DEL COMITÉ';
                $notificacion->Accion = 'USTED HA SIDO ELIMINADO DEL COMITE LLAMADO:' . $comite->NombreComite;
                $notificacion->id_usuario = $usuario->id;
                $notificacion->Estado = 'SIN LEER';
                $notificacion->tipo_notificacione_id = 1;

                $notificacion->save();
                $usuario->Comites()->detach($comite);
            }
        }
        $comite->SiglasComite = strtoupper($request->SiglasComite);
        $comite->NombreComite = $request->NombreComite;
        $comite->auditoria_id = $request->auditoria_id;
        $comite->created_at = $request->created_at;
        $now = Carbon::now();

        $comite->updated_at = $now->format('Y-m-d') . ' ' . $now->format('H:i');


        $comite->save();

        return redirect()->route('Comite.show', compact('comite'))->with('editar', 'ok');
    }

    // Función que permité crear un nuevo comité
    public function store(Request $request)
    {

        $Comites = Comite::all();
        $coincidencia = 0;

        // Bucle que permité validar algunos datos del comite
        foreach ($Comites as $comite) {
            // Validación de auditoría asignada
            if ($comite->auditoria_id == $request->auditoria_id) {
                $coincidencia = 1;
                // Validación de siglas del comité
            } elseif ($comite->SiglasComite == $request->SiglasComite) {
                $coincidencia = 2;
                // Validación de Nombre del comité
            } elseif ($comite->NombreComite == $request->NombreComite) {
                $coincidencia = 3;
            }
        }

        // Estructura condicional que emite un error en los siguientes casos 
        // 1.- Auditoría Asignada (coincidencia = 1)
        // 2.-Siglas utilizadas (coincidencia = 2)
        // 3.- Nombre del comité ya utilizado (coincidencia = 3)
        // En caso de que no exista ningun error el comité es creado y se notifica de su creación
        if ($coincidencia == 1) {
            $auditorias = Auditoria::all();
            $now = Carbon::now();
            return redirect()->route('Comite.create', compact('auditorias', 'now'))->with('errorAudAsignada', 'ok');
        } elseif ($coincidencia == 2) {

            $auditorias = Auditoria::all();
            $now = Carbon::now();
            return redirect()->route('Comite.create', compact('auditorias', 'now'))->with('errorSiglasDup', 'ok');
        } elseif ($coincidencia == 3) {
            $auditorias = Auditoria::all();
            $now = Carbon::now();
            return redirect()->route('Comite.create', compact('auditorias', 'now'))->with('errorNombreDup', 'ok');
        } else {
            $user = User::find(1);
            $comite = request()->except('_token');
            Comite::insert($comite);
            $siglas = $comite['SiglasComite'];
            $Comites = Comite::all();
            foreach ($Comites as $iterator) {

                if ($iterator->SiglasComite == $siglas) {
                    $comite = Comite::find($iterator->id);
                    $comite->Users()->attach(1);
                    return redirect()->route('Comite.asignar', compact('comite'))->with('crear', 'ok');
                }
            }


            //
        }
    }

    // Función que permite eliminar un comité en especifico.
    public function destroy(Comite $comite)
    {
        $integrantes = $comite->users;
        // Bucle que permite crear una notificación a cada uno de los profesores pertenecientes
        // a este comité de que fue eliminado.
        foreach ($integrantes as $integrante) {
            $notificacion = new Notificacione();
            $notificacion->NombreNotificacion = 'COMITÉ ELIMINADO';
            $notificacion->Accion = 'EL COMITÉ LLAMADO: ' . $comite->NombreComite . ' A SIDO ELIMINADO';
            $notificacion->id_usuario = $integrante->id;
            $notificacion->Estado = 'SIN LEER';
            $notificacion->tipo_notificacione_id = 1;

            $notificacion->save();
        }
        $comite->delete();
        return redirect()->route('Comite.index')->with('eliminar', 'ok');
    }

    // Función que permite eliminar a un integrante en específico
    public function eliminarDeComite(Request $request)
    {
        $usuario = User::find($request->usuario_id);
        $comite = Comite::find($request->comite_id);

        $notificacion = new Notificacione();
        $notificacion->NombreNotificacion = 'ELIMINADO DEL COMITE';
        $notificacion->Accion = 'USTED HA SIDO ELIMINADO DEEL COMITÉ LLAMADO: ' . $comite->NombreComite;
        $notificacion->id_usuario = $usuario->id;
        $notificacion->Estado = 'SIN LEER';
        $notificacion->tipo_notificacione_id = 1;

        $notificacion->save();

        $usuario->Comites()->detach($comite->id);
        $comite = Comite::find($request->comite_id);

        return redirect()->route('Comite.edit', compact('comite'))->with('eliminar', 'ok');
    }

    // Función que permite ver al profesor los comités a los que pertenece.
    public function misComites()
    {
        $usuario = User::find(auth()->user()->id);
        $comites = $usuario->comites;
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.comites.indexComite', compact('comites', 'notificaciones'));
    }

    // Función que permité ver las reuniones que ha tenido un comité en especifico.
    public function reuniones(Comite $comite)
    {
        $reuniones = Reunione::where("auditoria_id", $comite->auditoria_id)->get();
        return view('Admin.comite.reunionesComite', compact('reuniones', 'comite'));
    }
}
