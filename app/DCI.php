<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DCI extends Model
{
    protected $table = 'dcis';

    function medicamentos(){
        return $this->hasMany('App\Medicamento');
    }

}
