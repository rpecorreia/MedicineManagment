<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicamentos')->insert(['DCI_id' => '1', 'dosagem_id' => '1', 'forma_id' => '1', 'data_validade' => Carbon::create('2022', '06', '22')]);

    }
}
