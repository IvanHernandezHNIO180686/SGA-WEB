<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditarUsuario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Función que permite mostrar el perfil del administrador con todos sus datos, asi como su
    // imagen de perfil.
    public function perfil()
    {
        $usuario = User::find(Auth()->user()->id);
        return view('Admin.Perfil.PerfilAdmin', compact('usuario'));
    }

    //Función que permite ingresar al formulario con los datos del administrador, donde se muestran
    // los datos del administrador de una forma editable.
    public function editPerfil(User $user)
    {
        return view('Admin.Perfil.editPerfilAdmin', compact('user'));
    }

    // Función que recopila los datos del administrador ingresados en el formulario de
    // edición, para poder ser guardados dentro de la base de datos.
    public function update(EditarUsuario $request, User $user)
    {
        // Expresión condicional que permité obtener automaticamente las siglas pertenecientes
        // al administrador
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
        // Expresión condicional que permité identificar si el usuario ingreso una nueva foto de perfil.
        if ($request->hasFile('Foto')) {
            if ($user->Foto = '') {
                $user->Foto = $request->file('Foto')->store('uploads', 'public');
            } else {
                Storage::delete('public/' . $user->Foto);
                $user->Foto = $request->file('Foto')->store('uploads', 'public');
            }
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

        return redirect()->route('Admin.MiPerfil', compact('user'));
    }
}
