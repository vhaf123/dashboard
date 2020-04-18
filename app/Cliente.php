<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = ['name', 'telefono', 'dni', 'direccion', 'distrito', 'referencia'];

    //relación uno a muchos
    public function boletas()
    {
        return $this->hasMany('App\Boleta');
    }

    public function timelines()
    {
        return $this->hasMany('App\Timeline');
    }
}
