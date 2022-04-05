<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Comite;
use App\Models\Reunione;
use App\Models\Asistencia;
use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //  Función que permité identificar entre los tres diferentes usuarios que tiene el sistema
    // y que permite mostrar la página de inicio dependiendo el rol que tenga.
    public function index()
    {
        $cuenta = Auth()->user();

        // Estructura condicional que permite identifica la pagina de inicio correspondiente a la sesión
        // iniciada.
        // Adminitrador (rol = 1)
        // Profesor (rol = 2)
        // En espera (rol = 3)
        if ($cuenta->role_id == 1) {
            // Adminitrador (rol = 1)
            $now = Carbon::now();
            $fechaActual = $now->format('Y-m-d');
            $Reuniones = Reunione::where('FechaReunion', '>', $fechaActual)->paginate(5);
            $Auditorias = Auditoria::where('FechaAuditoria', '>', $fechaActual)->paginate(5);
            return view('Admin.PaginaInicio', compact('Reuniones', 'Auditorias'));

        } elseif ($cuenta->role_id == 2) {
            // Profesor (rol = 2)
            $usuario = User::find(Auth()->user()->id);

            $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)
                ->where('Estado', '=', 'Sin Leer')->count();
            $now = Carbon::now();
            $fechaActual = $now->format('Y-m-d');

            $comites = $usuario->comites;
            $reuniones = Reunione::all();
            $asistencias = Asistencia::where("Profesor", "=", $usuario->id)
                ->where("Estatus", "=", "Si asistire")
                ->get();
            $resultados = Reunione::join("auditorias", "auditorias.id", "=", "reuniones.auditoria_id")
                ->join("comites", "comites.id", "=", "auditorias.id")
                ->join("comite_user", "comite_user.comite_id", "=", "comites.id")
                ->join("estatus", "estatus.id", "=", "reuniones.estatu_id")
                ->join("tipo_sesiones", "tipo_sesiones.id", "=", "reuniones.tipo_sesione_id")
                ->where('comite_user.user_id', '=', $usuario->id)
                ->where('FechaReunion', '>=', $fechaActual)
                ->where("estatu_id", "=", "1")
                ->get();

            $empezadas = Reunione::join("auditorias", "auditorias.id", "=", "reuniones.auditoria_id")
                ->join("comites", "comites.id", "=", "auditorias.id")
                ->join("comite_user", "comite_user.comite_id", "=", "comites.id")
                ->join("estatus", "estatus.id", "=", "reuniones.estatu_id")
                ->join("tipo_sesiones", "tipo_sesiones.id", "=", "reuniones.tipo_sesione_id")
                ->where("comite_user.user_id", "=", $usuario->id)
                ->where("FechaReunion", ">=", $fechaActual)
                ->where("estatu_id", "=", "2")
                ->get();




            return view('Profesores.home', compact('resultados', 'comites', 'empezadas', 'reuniones', 'asistencias', 'notificaciones', 'usuario'));
            
        } else {
            // En espera (rol = 3)
            return view('welcome');
        }
    }
}
