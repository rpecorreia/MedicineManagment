<?php

use Illuminate\Database\Seeder;

class FormaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formas')->insert(['forma' => 'Comprimido de libertação prolongada']);
        DB::table('formas')->insert(['forma' => 'Comprimido orodispersível']);
        DB::table('formas')->insert(['forma' => 'Comprimido para mastigar']);
        DB::table('formas')->insert(['forma' => 'Comprimido revestido por película']);
        DB::table('formas')->insert(['forma' => 'Creme']);
        DB::table('formas')->insert(['forma' => 'Gotas orais']);
        DB::table('formas')->insert(['forma' => 'Granulado efervescente']);
        DB::table('formas')->insert(['forma' => 'Suspensão oral']);
        DB::table('formas')->insert(['forma' => 'Supositório']);
        DB::table('formas')->insert(['forma' => 'Xarope']);





    }
}
