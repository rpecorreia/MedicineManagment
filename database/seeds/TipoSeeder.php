<?php

use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert(['tipo' => 'Enviado']);
        DB::table('tipos')->insert(['tipo' => 'Recebido']);


    }
}
