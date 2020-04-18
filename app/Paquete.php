<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    //relación un a muchos
    public function boletas()
    {
        return $this->hasMany('App\Boleta');
    }
}
