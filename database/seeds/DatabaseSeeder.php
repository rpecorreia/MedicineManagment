<?php

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
        $this->call(HospitalSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DCISeeder::class);
        $this->call(DosagemSeeder::class);
        $this->call(FormaSeeder::class);
        $this->call(MedicamentoSeeder::class);
        $this->call(MedicamentoPorCHSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(PedidoSeeder::class);
        $this->call(PedidoLinhaSeeder::class);
        $this->call(EstadoPedido::class);
        $this->call(EstadoUserSeeder::class);






    }
}
