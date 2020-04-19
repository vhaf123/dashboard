<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = ['cliente_id', 'admin_id', 'accion', 'boleta'];

    //relacion uno a muchos (inversa)
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
