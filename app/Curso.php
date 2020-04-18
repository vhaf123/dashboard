<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //relación uno a muchos
    public function contratados()
    {
        return $this->hasMany('App\Contratado');
    }
}
