<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoUser extends Model
{
    function user(){
        return $this->hasMany('App\User');
    }
}
