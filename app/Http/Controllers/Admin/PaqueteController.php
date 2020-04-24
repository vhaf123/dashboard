<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Asesoria;
use App\Contratado;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.paquetes.index', compact('asesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $dias = DB::table('dias')->pluck('name', 'val');
        $boletas = DB::table('boletas')->orderBy('id', 'ASC')->pluck('id', 'id');

        return view('admin.paquetes.create', compact('asesores', 'cursos', 'dias', 'boletas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

            if($culminacion >= $fecha){
                
                $datos['fecha'] = carbon::parse($fecha);
                Asesoria::create($datos);
            }

            do{
                $fecha->addDay(7);
                if($culminacion >= $fecha){
                    $datos['fecha'] = carbon::parse($fecha);
                    Asesoria::create($datos);
                }
            }while($culminacion > $fecha);
        }

        
        return redirect()->route('admin.asesores.show', $datos['asesor_id'])->with('info', 'Nuevo paquete creado con con éxito');
    }

    public function asignarPaquete(Request $request){

        $contratado = Contratado::find($request->get('contratado'));

        $inicio = $contratado->boleta->inicio;
        $culminacion = $contratado->boleta->culminacion;
        $dias = explode(", ", $contratado->dias);

        $datos = [
            'boleta_id' => $contratado->boleta_id,
            'asesor_id' => $request->get('asesor_id'),
            'curso_id' => $contratado->curso_id,
            'fecha' => '',
            'h_inicio' => $contratado->h_inicio,
            'h_final' => $contratado->h_final,
            'duracion' => (strtotime($contratado->h_final) - strtotime($contratado->h_inicio))/60
        ];

        foreach($dias as $dia){
            $dia = diasIngles($dia);
            $fecha = carbon::parse($inicio)->subDay()->modify("next $dia");

            if($culminacion >= $fecha){
                
                $datos['fecha'] = carbon::parse($fecha);
                Asesoria::create($datos);
            }

            do{
                $fecha->addDay(7);
                if($culminacion >= $fecha){
                    $datos['fecha'] = carbon::parse($fecha);
                    Asesoria::create($datos);
                }
            }while($culminacion > $fecha);
        }

        $contratado->generado = 1;
        $contratado->save();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $contratado = Contratado::find($id);
        $contratado->generado = 1;
        $contratado->save();
    }
}
