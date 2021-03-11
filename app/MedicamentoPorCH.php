<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicamentoPorCH extends Model
{
    protected $table = 'medicamento_por_ch';

    function pedido() {
        return $this->belongsToMany("App\Pedido", "pedido_linhas");
    }

}
