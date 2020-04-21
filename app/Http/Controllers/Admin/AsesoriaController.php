<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Asesoria;
use App\Contratado;

use Carbon\Carbon;

class AsesoriaController extends Controller
{
    public function pendientes(){

        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.asesorias.pendientes', compact('asesores'));
    }

    public function asignarPaquete(Request $request){

        $contratado = Contratado::find($request->get('contratado'));

        $inicio = $contratado->boleta->inicio;
        $culminacion = $contratado->boleta->culminacion;

        $datos = [
            'boleta_id' => $contratado->boleta_id,
            'asesor_id' => $request->get('asesor_id'),
            'curso_id' => $contratado->curso_id,
            'fecha' => '',
            'h_inicio' => $contratado->h_inicio,
            'h_final' => $contratado->h_final,
            'duracion' => (strtotime($contratado->h_final) - strtotime($contratado->h_inicio))/60
        ];


        foreach (explode(", ", $contratado->dias) as $dia) {

            $dia = diasIngles($dia);
            $fecha = carbon::parse($inicio)->subDay()->modify("next $dia");
            $diasDiferencia = carbon::parse($culminacion)->diffInDays(carbon::parse($inicio));
            

            for ($i=0; $i < $diasDiferencia ; $i = $i + 7){
                if($i != 0){
                    $fecha->addDay(7);
                }

                if(carbon::parse($culminacion) >= $fecha){

                    $datos['fecha'] = carbon::parse($fecha);
                    Asesoria::create($datos);

                }
            }

        }

        $contratado->generado = 1;
        $contratado->save();

        /* return back()->with('info', 'Asesorias generadas con éxito'); */
       
    }

    public function eliminarPaquete(Contratado $contratado){
        $contratado->generado = 1;
        $contratado->save();
    }

    public function nuevoPaquete(){

        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $dias = DB::table('dias')->pluck('name', 'val');

        return view('admin.asesorias.nuevoPaquete', compact('asesores', 'cursos', 'dias'));
    }
}
