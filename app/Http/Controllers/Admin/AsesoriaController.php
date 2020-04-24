<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Asesoria;

class AsesoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('admin.asesorias.create', compact('asesores', 'cursos', 'dias', 'boletas'));
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
            'fecha' => 'required',
        ]);

        $datos = $request->all();

        $datos['fecha'] = Carbon::createFromFormat( 'd/m/Y', $datos['fecha'], 'GMT');
        $datos['duracion'] = (strtotime($datos['h_final']) - strtotime($datos['h_inicio']))/60;


        
        Asesoria::create($datos);

        return redirect()->route('admin.asesores.show', $datos['asesor_id'])->with('info', 'Nueva asesoría creada con con éxito');
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
    public function edit(Asesoria $asesoria)
    {

        $asesores = DB::table('asesors')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $dias = DB::table('dias')->pluck('name', 'val');
        $boletas = DB::table('boletas')->orderBy('id', 'ASC')->pluck('id', 'id');

        return view('admin.asesorias.edit', compact('asesoria', 'asesores', 'cursos', 'dias', 'boletas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asesoria $asesoria)
    {

        $request->validate([
           
            'fecha' => 'required',
        ]);

        $datos = $request->all();
        $datos['fecha'] = Carbon::createFromFormat( 'd/m/Y', $datos['fecha'], 'GMT');
        $datos['duracion'] = (strtotime($datos['h_final']) - strtotime($datos['h_inicio']))/60;

        $asesoria->fill($datos)->save();

        return redirect()->route('admin.asesores.show', $asesoria->asesor_id)
            ->with('info', 'La información de la asesoría se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asesoria $asesoria)
    {
        return $asesoria->delete();
    }
}
