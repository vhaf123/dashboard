<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = ['cliente_id', 'accion', 'accion_id'];

    //relacion uno a muchos (inversa)
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
