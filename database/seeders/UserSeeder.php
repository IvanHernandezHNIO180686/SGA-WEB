<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Usuario = new User();
        $Usuario->SiglasUsuario ="IGHN";
        $Usuario->Nombres ="IVAN GEOVANNY";
        $Usuario->ApellidoPaterno ="HERNANDEZ";
        $Usuario->ApellidoMaterno ="NINIZ";
        $Usuario->Puesto ="ADMINISTRADOR";
        $Usuario->email ="admin@admin.com";
        $Usuario->Foto = 'storage/uploads/usuario.png';
        $Usuario->password =Hash::make('admin');
        $Usuario->role_id =1;

        $Usuario->save();
    }
}
