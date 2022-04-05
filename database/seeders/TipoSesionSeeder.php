<?php

namespace Database\Seeders;

use App\Models\TipoSesione;
use Illuminate\Database\Seeder;

class TipoSesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoSesion1 = new TipoSesione();
        $tipoSesion1->NombreSesion ="ORDINARIA";
        $tipoSesion1->save();

        $tipoSesion2 = new TipoSesione();
        $tipoSesion2->NombreSesion ="EXTRAORDINARIA";
        $tipoSesion2->save();
    }
}
