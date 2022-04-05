<?php

namespace Database\Seeders;

use App\Models\Estatu;
use Illuminate\Database\Seeder;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Estatus1 = new Estatu();
        $Estatus1->NombreEstatus ="EN ESPERA";
        $Estatus1->save();

        $Estatus2 = new Estatu();
        $Estatus2->NombreEstatus ="INICIADA";
        $Estatus2->save();

        $Estatus3 = new Estatu();
        $Estatus3->NombreEstatus ="TERMINADA";
        $Estatus3->save();

        $Estatus4 = new Estatu();
        $Estatus4->NombreEstatus ="CANCELADA";
        $Estatus4->save();
    }
}
