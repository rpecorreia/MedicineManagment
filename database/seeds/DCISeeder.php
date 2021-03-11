<?php

use Illuminate\Database\Seeder;

class DCISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dcis')->insert(['DCI' => 'Ácido Fólico']);
        DB::table('dcis')->insert(['DCI' => 'Amorolfina']);
        DB::table('dcis')->insert(['DCI' => 'Cetotifeno']);
        DB::table('dcis')->insert(['DCI' => 'Dexcetoprofeno']);
        DB::table('dcis')->insert(['DCI' => 'domperidona']);
        DB::table('dcis')->insert(['DCI' => 'Hidrocortisona']);
        DB::table('dcis')->insert(['DCI' => 'Ipobrufeno']);
        DB::table('dcis')->insert(['DCI' => 'Loratadina']);
        DB::table('dcis')->insert(['DCI' => 'Pancreatina']);
        DB::table('dcis')->insert(['DCI' => 'Paracetamol + Cloridrato de difenidramina']);
        DB::table('dcis')->insert(['DCI' => 'Paracetamol + Codeína + Buclizina']);
        DB::table('dcis')->insert(['DCI' => 'Picetoprofeno']);
        DB::table('dcis')->insert(['DCI' => 'Triamcinolona ']);
        DB::table('dcis')->insert(['DCI' => 'Ulipristal']);



    }
}
