<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $fillable = ['cliente_id', 'categoria_id', 'numero_alumnos', 'alumno', 'institucion_id',
                            'paquete_id', 'horas', 'sesiones', 'anticipo', 'inicio', 'culminacion',
                            'costo', 'saldo', 'admin_id'];

    protected $dates = ['inicio', 'culminacion'];

    //relación uno a muchos
    public function contratados()
    {
        return $this->hasMany('App\Contratado');
    }
    
    //relacion uno a muchos (inversa)
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Institucion');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }


    public function paquete()
    {
        return $this->belongsTo('App\Paquete');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
