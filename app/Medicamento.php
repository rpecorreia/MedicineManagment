<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model

{

    function dci(){
        return $this->belongsTo('App\DCI');
    }

    function dosagem(){
        return $this->belongsTo('App\Dosagem');
    }

    function forma(){
        return $this->belongsTo('App\Forma');
    }

    function hospital() {
        return $this->belongsToMany("App\Hospital", "medicamento_por_ch");
    }


}
