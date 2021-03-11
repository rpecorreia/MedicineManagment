<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(['estado' => 'Muito urgente']);
        DB::table('estados')->insert(['estado' => 'Urgente']);
        DB::table('estados')->insert(['estado' => 'Pouco urgente']);
    }
}
