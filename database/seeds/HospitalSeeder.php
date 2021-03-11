<?php

use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert(['name' => 'Pêro da Covilhã', 'email' => ' info@chcbeira.min-saude.pt', 'tlm' => '275 330 000']);
        DB::table('hospitals')->insert(['name' => 'S.João', 'email' => '  geral@chsj.min-saude.pt', 'tlm' => '225 512 100']);
        DB::table('hospitals')->insert(['name' => 'Sta. Maria', 'email' => 'hsm@hsmporto.pt', 'tlm' => '225 082 000']);

    }
}
