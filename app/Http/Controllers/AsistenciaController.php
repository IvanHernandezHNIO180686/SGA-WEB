<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Auditoria;
use App\Models\Notificacione;
use App\Models\Reunione;
use App\Models\User;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    // Función que permité visualizar todas las asistencias que el usuario con sesión activa dentro
    // del sistema ha tenido, además de enviar a la vista los datos para la gráfica.
    public function index()
    {
        $usuario = User::find(Auth()->user()->id);
        $asistencias = Asistencia::where("Profesor", "=", $usuario->id)->paginate(5);
        $auditorias = Auditoria::all();
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)
            ->where('Estado', '=', 'Sin Leer')->count();

        $aud = User::join('comite_user', 'comite_user.user_id', '=', 'users.id')
            ->join('comites', 'comites.id', '=', 'comite_user.comite_id')
            ->join('auditorias', 'auditorias.id', '=', 'comites.auditoria_id')
            ->where('users.id', '=', $usuario->id)
            ->take(5)
            ->get();

        // Bucle que permite recaudar el nombre de una auditoria y las cadidades de reuniones que ha
        // tenido dentro de un arrelgo llamado puntos.
        $puntos = [];
        foreach ($aud as $iterator) {
            $reuniones = Reunione::where('auditoria_id', '=', $iterator->id)->count();
            $puntos[] = ['name' => $iterator->SiglasAuditoria, 'y' => $reuniones];
        }
        return view('Profesores.Asistencias.indexAsistencia', ["data" => json_encode($puntos)], compact('asistencias', 'usuario', 'auditorias', 'notificaciones'));
    }

    // Función que permite confirmar o denegar una asistencia a una reunión.
    public function store(Request $request, Reunione $reunion)
    {
        $usuario = User::find(Auth()->user()->id);
        $cont = 0;
        $asistencias = Asistencia::all();

        // Expresión condicional que permité saber si un usuario ya confirmo su asistencia o no
        foreach ($asistencias as $iterator) {
            if ($iterator->Profesor == $usuario->id && $iterator->reunione_id == $reunion->id) {
                $cont = 1;
            }
        }

        // Expresión condicional que permité notificar al usuario si ya tomo una decisión respecto a su
        // asistencia dentro de una reunión o en caso de que no el sistema detecta si asistira o no a
        // reunión.
        if ($cont == 1) {
            return redirect()->route('Asistencia.index')->with('error', 'ok');
        } else {
            if ($request->respuesta == 1) {
                $asistencia = new Asistencia();
                $asistencia->reunione_id = $reunion->id;
                $asistencia->Profesor = $usuario->id;
                $asistencia->Estatus = 'Si asistire';
                $asistencia->save();
            } elseif ($request->respuesta == 2) {
                $asistencia = new Asistencia();
                $asistencia->reunione_id = $reunion->id;
                $asistencia->Profesor = $usuario->id;
                $asistencia->Estatus = 'No asistire';
                $asistencia->save();
            }
            return redirect()->route('Asistencia.index')->with('confirmación', 'ok');
        }
    }

    // Una vez que el sistema inicie una reunión y el usuario confirmo su asistencia previamente, este
    // podrá visualizar el pase de lista dentro del sistema, por ello esta función ayuda a actualizar
    // el estatus de Si asistire y cambiarlo por Asistencia.
    public function update(Asistencia $asistencia)
    {
        $asistencia->Estatus = "Asistencia";
        $asistencia->save();
        return redirect()->route('Asistencia.index')->with('asistencia', 'ok');
    }
}
