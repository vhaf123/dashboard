<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

use App\Boleta;
use App\Timeline;
use App\Contratado;

class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.boletas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Boleta $boleta)
    {
        $cursos = DB::table('cursos')->pluck('name', 'id');
        $niveles = DB::table('niveles')->pluck('name', 'id');
        /* $dias = DB::table('dias')->get(); */
        
        return view('admin.boletas.show', compact('boleta', 'cursos', 'niveles'));
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
    public function destroy(Boleta $boleta)
    {
        $boleta->estado = "ANULADO";
        $boleta->save();

        return back();
    }

    public function agregarCursos(Request $request, Boleta $boleta)
    {
        $datos = $request->all();

        //formatear hora
        $datos['h_inicio'] = formatearHora($datos['h_inicio']);
        $datos['h_final'] = formatearHora($datos['h_final']);
        $datos['dias'] = implode( ", " ,$datos['dias']);
               
        Contratado::create($datos);
        return view('admin.boletas.cursos.index', ['boleta' => $boleta]);

    }

    public function borrarCursos(Request $request, Contratado $curso){

        $curso->delete();
        return view('admin.boletas.cursos.index', ['boleta' => Boleta::find($curso->boleta_id)]);
        
    }

    public function generarPDF(Boleta $boleta){

        $boleta->estado = "DESCARGADO";
        $boleta->save();
      
        $pdf = resolve('dompdf.wrapper');
        $pdf = PDF::loadView('admin.boletas.partials.pdf', compact('boleta'))->setPaper('a4', 'landscape');
        return $pdf->stream();

    }
}
