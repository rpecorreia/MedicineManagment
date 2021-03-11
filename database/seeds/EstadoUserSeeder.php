<?php

use Illuminate\Database\Seeder;

class EstadoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_users')->insert(['estado' => 'Efetivo']);
        DB::table('estado_users')->insert(['estado' => 'Auxiliar']);
        DB::table('estado_users')->insert(['estado' => 'Pendente']);
        DB::table('estado_users')->insert(['estado' => 'Inativo']);

    }

}
