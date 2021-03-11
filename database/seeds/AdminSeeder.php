<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(['name' => 'AdminCovilhã', 'email' => 'administradorcovi@gmail.com', 'password' => Hash::make("adm123"), 'hospital_id' => 1]);
        DB::table('admins')->insert(['name' => 'AdminS.Joao', 'email' => 'administradorsjoao@gmail.com', 'password' => Hash::make("adm456"), 'hospital_id' => 2]);
        DB::table('admins')->insert(['name' => 'AdminSta.Maria', 'email' => 'administradorstamaria@gmail.com', 'password' => Hash::make("adm789"), 'hospital_id' => 3]);


    }
}
