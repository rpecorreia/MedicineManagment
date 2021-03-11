<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    function pedidos(){
        return $this->hasMany('App\Pedido');
    }
}
