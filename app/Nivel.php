<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';

    //relación uno a muchos
    public function contratados()
    {
        return $this->hasMany('App\Contratado');
    }
}
