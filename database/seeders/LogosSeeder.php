<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logo;

class LogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logo1 = new Logo();
        $logo1->NombreLogo = "Roja";
        $logo1->ruta = "storage/images/UPE_Firma_vert_roja-01.png";
        $logo1->save();

        $logo2 = new Logo();
        $logo2->NombreLogo = "Amarilla";
        $logo2->ruta = "storage/images/UPE_Firma_horiz_amarilla-01.png";
        $logo2->save();

    }
}
