<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Rol1 = new Role();
        $Rol1->NombreRol ="ADMIN";
        $Rol1->save();

        $Rol2 = new Role();
        $Rol2->NombreRol ="USUARIO";
        $Rol2->save();

        $Rol3 = new Role();
        $Rol3->NombreRol ="EN ESPERA";
        $Rol3->save();
    }
}
