<?php

use Illuminate\Database\Seeder;

class DosagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosagens')->insert(['dosagem' => '1mg']);
        DB::table('dosagens')->insert(['dosagem' => '2.5mg']);
        DB::table('dosagens')->insert(['dosagem' => '3mg']);
        DB::table('dosagens')->insert(['dosagem' => '10mg']);
        DB::table('dosagens')->insert(['dosagem' => '12,72mg']);
        DB::table('dosagens')->insert(['dosagem' => '19mg']);
        DB::table('dosagens')->insert(['dosagem' => '20mg']);
        DB::table('dosagens')->insert(['dosagem' => '30mg']);
        DB::table('dosagens')->insert(['dosagem' => '60mg']);
        DB::table('dosagens')->insert(['dosagem' => '100mg']);
        DB::table('dosagens')->insert(['dosagem' => '200mg']);
        DB::table('dosagens')->insert(['dosagem' => '300mg']);
        DB::table('dosagens')->insert(['dosagem' => '400mg']);
        DB::table('dosagens')->insert(['dosagem' => '500mg']);
        DB::table('dosagens')->insert(['dosagem' => '600mg']);
        DB::table('dosagens')->insert(['dosagem' => '625mg']);
        DB::table('dosagens')->insert(['dosagem' => '700mg']);
        DB::table('dosagens')->insert(['dosagem' => '800mg']);



    }
}
