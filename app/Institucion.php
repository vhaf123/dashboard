<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';

    //relación uno a muchos
    public function boletas()
    {
        return $this->hasMany('App\Boleta');
    }
}
