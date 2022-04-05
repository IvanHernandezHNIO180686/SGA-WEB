<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarUsuario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfesoresController extends Controller
{
    // Función que permite visualizar el perfil del profesor que tiene sesión activa.
    public function perfil()
    {
        $usuario = User::find(Auth()->user()->id);
        return view('Profesores.Perfil.PerfilProfesor', compact('usuario'));
    }

    // Función que permité mostrar el formulario de edición de perfil para un profesor.
    public function editPerfil(User $user)
    {
        return view('Profesores.Perfil.editPerfil', compact('user'));
    }

    // Función que permite recopilar los datos modificados del formulario de edición de 
    // perfil para posteriormente guardar los cambios.
    public function update(EditarUsuario $request, User $user)
    {
        // Estructura condicional que permite generar las nuevas siglas del usuario 
        // en caso de que el nombre del profesor haya sido modificado.
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

        // Estructura condicional que permite guardar la nueva foto del usuario 
        // en caso de que la foto haya sido modificada.
        if ($request->hasFile('Foto')) {
            Storage::delete('public/' . $user->Foto);
            $user->Foto = $request->file('Foto')->store('uploads', 'public');
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

        return redirect()->route('Profesores.MiPerfil', compact('user')) - with('cambio', 'ok');
    }
}
