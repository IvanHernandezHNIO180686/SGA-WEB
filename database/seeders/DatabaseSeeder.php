<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstatusSeeder::class);
        $this->call(TipoAuditoriaSeeder::class);
        $this->call(TipoSesionSeeder::class);
        $this->call(LogosSeeder::class);
        $this->call(TipoNotificacionSeeder::class);
    }
}
