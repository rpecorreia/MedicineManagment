<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    function users(){
        return $this->hasMany('App\User');
    }

    function medicamento() {
        return $this->belongsToMany("App\Medicamento", "medicamento_por_ch");

    }
    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

}
