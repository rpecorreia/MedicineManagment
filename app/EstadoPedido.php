<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    function pedido(){
        return $this->hasMany('App\Pedido');
    }
}
