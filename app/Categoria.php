<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //relación uno a muchos
    public function boletas()
    {
        return $this->hasMany('App\Boleta');
    }
}
