<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'Nombres' => ['required', 'string', 'max:255'],
            'ApellidoPaterno' => ['required', 'string'],
            'Puesto' => ['required', 'string'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        if ($input['ApellidoMaterno'] == '') {
            $LetrasNombre = substr($input['Nombres'], 0, 2);
            $LetrasPaterno = substr($input['ApellidoPaterno'], 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno;
        } else {
            $LetrasNombre = substr($input['Nombres'], 0, 2);
            $LetrasPaterno = substr($input['ApellidoPaterno'], 0, 2);
            $LetrasMaterno = substr($input['ApellidoMaterno'], 0, 2);
            $SiglasUsuario = $LetrasNombre . $LetrasPaterno . $LetrasMaterno;
        }

        return User::create([
            'SiglasUsuario' => $SiglasUsuario,
            'Nombres' => $input['Nombres'],
            'ApellidoPaterno' => $input['ApellidoPaterno'],
            'ApellidoMaterno' => $input['ApellidoMaterno'],
            'Puesto' => $input['Puesto'],
            'role_id'=> 3,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
