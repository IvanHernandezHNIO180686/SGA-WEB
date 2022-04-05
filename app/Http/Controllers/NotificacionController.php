<?php

namespace App\Http\Controllers;

use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    // Función que permite obtener todas las notificaciones en general pertenecientes al usuario 
    // con sesión activa .
    protected function optenerNotificacionesU()
    {
        $usuario = User::find(auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)->get();
        return $notificaciones;
    }

    // Función que permite obtener todas las notificaciones sin leer pertenecientes al usuario 
    // con sesión activa .
    protected function optenerNotificaciones()
    {
        $usuario = User::find(auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)->where('Estado', '=', 'Sin Leer')->count();
        return $notificaciones;
    }

    // Función que muestra la interfaz con todas las notificaciones pertenecientes al usuario
    // con sesión activa.
    public function index()
    {
        $notificacionesU = $this->optenerNotificacionesU();
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.notificaciones.indexNotificacion', compact('notificacionesU', 'notificaciones'));
    }

    // Función que permité editar el estato de la notificación del usuario con sesión activa a 'Leído'
    public function update(Notificacione $notificacion)
    {
        $notificacion->Estado = 'Leido';
        $notificacion->save();
        $notificacionesU = $this->optenerNotificacionesU();
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.notificaciones.indexNotificacion', compact('notificacionesU', 'notificaciones'));
    }

    // Función que permité eliminar una notificación en específico.
    public function destroy(Notificacione $notificacion)
    {
        $notificacion->delete();
        $notificaciones = $this->optenerNotificaciones();
        return redirect()->route('Notificacion.misNotificaciones', compact('notificaciones'));
    }
}
