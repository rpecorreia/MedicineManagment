<?php

use Illuminate\Database\Seeder;

class EstadoPedido extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_pedidos')->insert(['estado_pedido' => 'Recebido']);
        DB::table('estado_pedidos')->insert(['estado_pedido' => 'Em distribuição']);
        DB::table('estado_pedidos')->insert(['estado_pedido' => 'Chegada ao destino']);
        DB::table('estado_pedidos')->insert(['estado_pedido' => 'Rejeitado']);

    }
}
