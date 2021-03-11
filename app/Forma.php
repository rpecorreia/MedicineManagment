<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma extends Model
{
    function medicamentos(){
        return $this->hasMany('App\Medicamento');
    }
}
