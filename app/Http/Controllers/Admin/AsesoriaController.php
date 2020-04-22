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
            

            for ($i=0; $i <= $diasDiferencia ; $i = $i + 7){
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
       
    }

    public function eliminarPaquete(Contratado $contratado){
        $contratado->generado = 1;
        $contratado->save();
    }

    public function nuevoPaquete(){

        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $dias = DB::table('dias')->pluck('name', 'val');
        $boletas = DB::table('boletas')->orderBy('id', 'ASC')->pluck('id', 'id');

        return view('admin.asesorias.nuevoPaquete', compact('asesores', 'cursos', 'dias', 'boletas'));
    }

    public function storePaquete(Request $request){

        $request->validate([
            'boleta_id' => 'required',
            'dias' => 'required',
        ]);

        $datos = [
            'boleta_id' => $request->get('boleta_id'),
            'asesor_id' => $request->get('asesor_id'),
            'curso_id' => $request->get('curso_id'),
            'fecha' => '',
            'h_inicio' => $request->get('h_inicio'),
            'h_final' => $request->get('h_final'),
            'duracion' => (strtotime($request->get('h_final')) - strtotime($request->get('h_inicio')))/60
        ];

        $inicio_culminacion = explode(' - ', $request->get('fecha'));
        $inicio = Carbon::createFromFormat( 'd/m/Y', $inicio_culminacion[0], 'GMT');
        $culminacion = Carbon::createFromFormat( 'd/m/Y', $inicio_culminacion[1], 'GMT');

        foreach($request->get('dias') as $dia){
            $dia = diasIngles($dia);
            $fecha = carbon::parse($inicio)->subDay()->modify("next $dia");
            $diasDiferencia = carbon::parse($culminacion)->diffInDays(carbon::parse($inicio));
            

            for ($i=0; $i <= $diasDiferencia ; $i = $i + 7){
                if($i != 0){
                    $fecha->addDay(7);
                }

                if(carbon::parse($culminacion) >= $fecha){

                    $datos['fecha'] = carbon::parse($fecha);
                    Asesoria::create($datos);
                }
            }
        }

        
        return redirect()->route('admin.asesorias.pendientes')->with('info', 'Nuevo paquete creado con con éxito');
        
    }

    public function nuevaAsesoria(){
        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $dias = DB::table('dias')->pluck('name', 'val');
        $boletas = DB::table('boletas')->orderBy('id', 'ASC')->pluck('id', 'id');

        return view('admin.asesorias.nuevaAsesoria', compact('asesores', 'cursos', 'dias', 'boletas'));
    }

    public function storeAsesoria(Request $request){
        $request->validate([
            'boleta_id' => 'required',
            'fecha' => 'required',
        ]);

        $datos = $request->all();

        $datos['fecha'] = Carbon::createFromFormat( 'd/m/Y', $datos['fecha'], 'GMT');
        $datos['duracion'] = (strtotime($datos['h_final']) - strtotime($datos['h_inicio']))/60;

        Asesoria::create($datos);

        return redirect()->route('admin.asesorias.pendientes')->with('info', 'Nueva asesoría creada con con éxito');
    }
}
