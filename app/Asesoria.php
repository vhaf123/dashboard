<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    
    protected $fillable = ['boleta_id', 'asesor_id', 'curso_id', 'fecha', 'h_inicio', 'h_final', 'duracion'];

    protected $dates = ['fecha', 'h_inicio', 'h_final'];
    
    //relacion uno a muchos (inversa)
    public function boleta()
    {
        return $this->belongsTo('App\Boleta');
    }

    public function asesor()
    {
        return $this->belongsTo('App\Models\Asesor');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }




    /* Query Scopes */

    public function scopeDesde($query, $desde){
        if($desde){
            return $query->whereDate('fecha', '>=', $desde);
        }
    }

    public function scopeHasta($query, $hasta){
        if($hasta){
            return $query->whereDate('fecha', '<=', $hasta);
        }
    }

}
