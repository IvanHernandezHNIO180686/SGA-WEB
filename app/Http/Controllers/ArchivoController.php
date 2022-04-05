<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Acuerdo;
use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArchivoController extends Controller
{
    //Función que permité obtener las notificaciones pertenecientes al usuario con la sesión activa.
    protected function optenerNotificaciones()
    {
        $usuario = User::find(auth()->user()->id);
        $notificaciones = Notificacione::where('id_usuario', '=', $usuario->id)->where('Estado', '=', 'SIN LEER')->count();
        return $notificaciones;
    }

    // Función que permite registrar un nuevo archivo para un acuerdo.
    public function store(Acuerdo $acuerdo, Request $request)
    {

        $archivos = Archivo::all();
        $cont = 0;
        foreach ($archivos as $archivo) {
            $cont = $cont + 1;
        }

        // Estructura condicional que permite crear un número de folio para un archivo.
        if ($cont < 10) {
            $folio = "A-000" . $cont;
        } elseif ($cont < 100) {
            $folio = "A-00" . $cont;
        } elseif ($cont < 1000) {
            $folio = "A-0" . $cont;
        } elseif ($cont < 10000) {
            $folio = "A-" . $cont;
        }

        $archivo = new Archivo();
        $uuid = (string) Str::uuid();
        $now = Carbon::now();
        $archivo->uuid = $uuid;
        $archivo->Folio = $folio;
        $archivo->NombreRequerimiento = $request->NombreRequerimiento;
        $archivo->Descripcion = $request->Descripcion;
        $archivo->created_at = $now;
        $archivo->updated_at = $now;
        $archivo->acuerdo_id = $acuerdo->id;

        $archivo->save();

        return redirect()->route('Acuerdo.show', $acuerdo);
    }

    //Función que permite eliminar un archivo
    public function destroy(Archivo $archivo)
    {
        $acuerdo = Acuerdo::find($archivo->acuerdo_id);
        $carpeta = $archivo->Ruta;
        $ruta = storage_path('app/public/' . $carpeta);

        $archivo->delete();
        return redirect()->route('Acuerdo.show', $acuerdo)->with('eliminar', 'ok');
    }

    //Funcion que permité agregar un nuevo requerimiento a un acuerdo creado.
    public function requerimientos(Acuerdo $acuerdo)
    {
        $archivos = Archivo::all();
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.Acuerdos.requerimientosAcuerdo', compact('archivos', 'acuerdo', 'notificaciones'));
    }

    // Función que permité visualizar la vista para poder subir un archivo a un requerimiento.
    public function subirArchivo(Archivo $archivo)
    {
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.archivos.requerimientoAcuerdo', compact('archivo', 'notificaciones'));
    }

    // Función que permite actualizar un archivo
    public function update(Archivo $archivo, Request $request)
    {

        $folio = $archivo->Folio;
        // Estructura condicional que permité identificar si se recivío un archivo dentro del formulario de
        // edición.
        if ($request->hasFile('archivo_requerimiento')) {
            $archivo->ruta = $request->file('archivo_requerimiento')->store('archivos_acuerdos', 'public');
        }
        $archivo->save();

        $archivos = Archivo::all();
        $acuerdo = Acuerdo::find($archivo->acuerdo_id);
        $notificaciones = $this->optenerNotificaciones();
        return view('Profesores.Acuerdos.requerimientosAcuerdo', compact('acuerdo', 'archivos', 'notificaciones'));
    }

    // Función que permité descargar un archivo.
    public function download($uuid)
    {
        $archivo = Archivo::where('uuid', $uuid)->firstOrFail();
        $carpeta = $archivo->Ruta;
        $ruta = storage_path('app/public/' . $carpeta);

        return response()->download($ruta);
    }
}
