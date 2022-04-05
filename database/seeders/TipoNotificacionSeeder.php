<?php

namespace Database\Seeders;

use App\Models\TipoNotificacione;
use Illuminate\Database\Seeder;

class TipoNotificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoNotificacion1 = new TipoNotificacione();
        $tipoNotificacion1->NombreTipo ="COMITE";
        $tipoNotificacion1->save();

        $tipoNotificacion2 = new TipoNotificacione();
        $tipoNotificacion2->NombreTipo ="REUNION";
        $tipoNotificacion2->save();

        $tipoNotificacion3 = new TipoNotificacione();
        $tipoNotificacion3->NombreTipo ="ACUERDO";
        $tipoNotificacion3->save();

        $tipoNotificacion4 = new TipoNotificacione();
        $tipoNotificacion4->NombreTipo ="AddREUNION";
        $tipoNotificacion4->save();
    }
}
