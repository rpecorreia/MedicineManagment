<?php

namespace Tests\Unit;

use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    //pag principal redireciona para o login
    public function testelogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    public function testedashboard()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testemedlocal()
    {
        $response = $this->get('/listarmedlocal');
        $response->assertStatus(302);
    }

    public function testemedglobal()
    {
        $response = $this->get('/listarmedglobal');
        $response->assertStatus(302);
    }

    public function testefazerpedido()
    {
        $response = $this->get('/fazerpedido');
        $response->assertStatus(302);
    }

    public function testepedidosrecebidos()
    {
        $response = $this->get('/pedidosrecebidos');
        $response->assertStatus(302);
    }

    public function testepedidosenviados()
    {
        $response = $this->get('/pedidosenviados');
        $response->assertStatus(302);
    }

    public function testemovimentos()
    {
        $response = $this->get('/movimentos');
        $response->assertStatus(302);
    }

    public function testecontactos()
    {
        $response = $this->get('/contactos');
        $response->assertStatus(302);
    }





}





