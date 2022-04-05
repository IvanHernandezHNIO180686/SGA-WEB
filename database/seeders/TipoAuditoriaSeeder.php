<?php

namespace Database\Seeders;

use App\Models\TipoAuditoria;
use Illuminate\Database\Seeder;

class TipoAuditoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoAuditoria1 = new TipoAuditoria();
        $tipoAuditoria1->NombreTipo ="INTERNA";
        $tipoAuditoria1->save();

        $tipoAuditoria2 = new TipoAuditoria();
        $tipoAuditoria2->NombreTipo ="EXTERNA";
        $tipoAuditoria2->save();
    }
}
