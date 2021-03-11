<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    function estado(){
        return $this->belongsTo('App\Estado');
    }

    function tipo(){
        return $this->belongsTo('App\Tipo');
    }

    function medporhospital() {
        return $this->belongsToMany("App\MedicamentoPorCH", "pedido_linhas");

    }
}
