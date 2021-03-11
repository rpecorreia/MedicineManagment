<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosagem extends Model
{
    protected $table = 'dosagens';

    function medicamentos(){
        return $this->hasMany('App\Medicamento');
    }

}
