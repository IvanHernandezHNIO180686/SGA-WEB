<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarUsuario;
use App\Models\Auditoria;
use App\Models\User;
use App\Models\Comite;
use App\Models\Notificacione;
use App\Models\Reunione;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Función que permité ver la página de inicio de los usuarios desde el menú de administrador
    public function index()
    {
        return view('Admin.Usuario.indexUsuario');
    }

    // Función que muestra el formulario de registro de un nuevo profesor.
    public function create()
    {
        $now = Carbon::now();
        return view('Admin.Usuario.createUsuario', compact('now'));
    }

    // Función que recopila la información dada en el formulario de registro de un nuevo profesor
    // para posteriormente registrarlo en la BD.
    public function store(Request $request)
    {

        // Estructura que permité crear las siglas del usuario dependiendo el nombre completo del mismo
        if ($request->ApellidoMaterno == '') {
            // Si no tiene apellido materno
            $LetrasNombre = substr($request->Nombres, 0, 2);
            $LetrasPaterno = substr($request->ApellidoPaterno, 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno;
        } else {
            // Si tiene apellido materno
            $LetrasNombre = substr($request->Nombres, 0, 2);
            $LetrasPaterno = substr($request->ApellidoPaterno, 0, 2);
            $LetrasMaterno = substr($request->ApellidoMaterno, 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno . $LetrasMaterno;
        }


        $usuario = User::where('SiglasUsuario', '=', $SiglasUsuario)->get()->count();
        $correo = User::where('email', '=', $request->email)->get()->count();


        // Estructura que ayuda a saber si ya el usuario se encuentra registrado dentro del sistema
        if ($usuario > 0 || $correo > 0) {
            $coincidencia = 1;
        } else {
            $coincidencia = 0;
        }


        if ($coincidencia == 1) {
            // En caso de que el usuario ya se encuentre registrado se emitirá un mensaje de error.
            $now = Carbon::now();
            return redirect()->route('User.create', compact('now'))->with('error', 'ok');
        } else {
            // Si el usuario no se encuentra registrado se procede a guardar el registro
            $datosUsuario = new User();
            // Estructura que guarda la foto de perfil del usuario en caso de haberla ingresado
            if ($request->hasFile('Foto')) {
                $datosUsuario->Foto = $request->file('Foto')->store('uploads', 'public');
            }
            $datosUsuario->SiglasUsuario = $SiglasUsuario;
            $datosUsuario->Nombres = $request->Nombres;
            $datosUsuario->ApellidoPaterno = $request->ApellidoPaterno;
            $datosUsuario->ApellidoMaterno = $request->ApellidoMaterno;
            $datosUsuario->Puesto = $request->Puesto;
            $datosUsuario->email = $request->email;
            $datosUsuario->email_verified_at = $request->email_verified_at;
            $datosUsuario->password = Hash::make($request->password);
            $datosUsuario->created_at = $request->created_at;
            $datosUsuario->updated_at = $request->updated_at;
            $datosUsuario->role_id = '2';

            $datosUsuario->save();
            return redirect()->route('User.index')->with('guardado', 'ok');
        }
    }

    // Función que muestra la interfaz para agregar al usuario a un acuerdo.
    public function asignar(User $user)
    {
        $comites = Comite::all();
        return view('Admin.Usuario.AsignarComite', compact('user'), compact('comites'));
    }

    // Función que ayuda a agregar a un usuario dentro de un comité
    public function insertarAcomite(Request $request)
    {
        $comites = Comite::find($request->comite_id);
        $usuarios = $comites->users;
        $coincidencia = 0;
        // Bucle que permite identificar si el usuario ya esta registrado dentro del comité
        foreach ($usuarios as $user) {
            if ($user->id == $request->id) {
                $coincidencia = 1;
            }
        }

        // Emición de error si el profesor ya se encientra en el comité
        if ($coincidencia == 1) {
            return redirect()->route('User.asignar', $request->id)->with('error', 'ok');
        } else {
            $usuario = User::find($request->id);
            $buscarComite = Comite::find($request->comite_id);
            $usuario->Comites()->attach($request->comite_id);


            $notificacion = new Notificacione();
            $notificacion->NombreNotificacion = 'ASIGNACIÓN DE A COMITÉ';
            $notificacion->Accion = 'HA SIDO AGREGADO AL COMITÉ QUE LLAMADO ' . $buscarComite->NombreComite;
            $notificacion->id_usuario = $request->id;
            $notificacion->Estado = 'SIN LEER';
            $notificacion->tipo_notificacione_id = 1;

            $notificacion->save();

            return redirect()->route('User.index')->with('asignacion', 'ok');
        }
    }

    // Función que muestra el formulario de edición de un usuario.
    public function edit(User $user)
    {
        return view('Admin.Usuario.editUsuario', compact('user'));
    }

    // Función que permité guardar los datos modificados de un usuario
    public function update(EditarUsuario $request, User $user)
    {
        // Estructura que permité crear las siglas del usuario dependiendo el nombre completo del mismo
        if ($request->ApellidoMaterno == '') {
            $LetrasNombre = substr($request->Nombres, 0, 2);
            $LetrasPaterno = substr($request->ApellidoPaterno, 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno;
        } else {
            $LetrasNombre = substr($request->Nombres, 0, 2);
            $LetrasPaterno = substr($request->ApellidoPaterno, 0, 2);
            $LetrasMaterno = substr($request->ApellidoMaterno, 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno . $LetrasMaterno;
        }

        $user->SiglasUsuario = strtoupper($SiglasUsuario);
        $user->Nombres = strtoupper($request->Nombres);
        $user->ApellidoPaterno = strtoupper($request->ApellidoPaterno);
        $user->ApellidoMaterno = strtoupper($request->ApellidoMaterno);
        $user->Puesto = strtoupper($request->Puesto);
        $user->email = $request->email;
        $user->created_at = $request->created_at;
        $now = Carbon::now();

        $user->updated_at = $now->format('Y-m-d') . ' ' . $now->format('H:i');

        $user->save();

        return redirect()->route('User.index')->with('editar', 'ok');
    }

    // Función que permite eliminar un usuario en específico
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('User.index')->with('eliminar', 'ok');
    }

    // Función que deniega un registro dentro del sistema
    public function denegar(User $user)
    {
        $user->delete();
        return redirect()->route('home')->with('eliminar', 'ok');
    }

    // Función que cambia el rol de un registro individal al ser aceptado de "en espera" a "profesor"
    public function aceptar(User $user)
    {
        $user->role_id = 2;
        $user->save();

        $now = Carbon::now();
        $fechaActual = $now->format('Y-m-d');
        $Reuniones = Reunione::where('FechaReunion', '>', $fechaActual)->paginate(5);
        $Auditorias = Auditoria::where('FechaAuditoria', '>', $fechaActual)->paginate(5);
        return view('Admin.PaginaInicio', compact('Reuniones', 'Auditorias'))->with('aceptar', 'ok');
    }
}
