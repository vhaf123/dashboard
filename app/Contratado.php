<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratado extends Model
{
    protected $fillable = ['boleta_id', 'curso_id', 'nivel_id', 'dias', 'h_inicio', 'h_final'];

    //relacion uno a muchos (inversa)

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function nivel()
    {
        return $this->belongsTo('App\Nivel');
    }

    public function boleta()
    {
        return $this->belongsTo('App\Boleta');
    }

}
