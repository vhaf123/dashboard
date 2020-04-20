<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        $clientes = DB::table('clientes')->orderBy('name', 'ASC')->pluck('name', 'id');
        $categorias = DB::table('categorias')->orderBy('name', 'ASC')->pluck('name', 'id');
        $instituciones = DB::table('instituciones')->pluck('name', 'id');
        $paquetes = DB::table('paquetes')->pluck('name', 'id');
        $admins = DB::table('admins')->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.boletas.create', compact('clientes', 'categorias', 'instituciones', 'paquetes', 'admins'));
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
            'cliente_id' => 'required',
            'numero_alumnos' => 'required',
            'alumno' => 'required',
            "horas" => 'required',
            "sesiones" => 'required',
            'anticipo' => 'required',
        ]);

        $fecha = explode(' - ', $request->get('fecha'));
        $precio = DB::table('categorias')->find($request->get('categoria_id'))->precio_cli;
        $datos = $request->all();

        $datos['inicio'] = Carbon::createFromFormat( 'd/m/Y', $fecha[0], 'GMT');
        $datos['culminacion'] = Carbon::createFromFormat( 'd/m/Y', $fecha[1]);
        $datos['costo'] = $precio * $request->get('horas');
        $datos['saldo'] = $datos['costo'] - $request->get('anticipo');

        $boleta = Boleta::create($datos);

        Timeline::create([
            'cliente_id' => $boleta->cliente_id,
            'admin_id' => \Auth::guard('admin')->user()->id,
            'accion' => 'create_boleta',
            'boleta' => $boleta->id
        ]);
    
        return redirect()->route('admin.boletas.show', $boleta)->with('info', 'Boleta ' . $boleta->id . ' creado con éxito');
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
    public function edit(Boleta $boleta)
    {
        $clientes = DB::table('clientes')->orderBy('name', 'ASC')->pluck('name', 'id');
        $categorias = DB::table('categorias')->orderBy('name', 'ASC')->pluck('name', 'id');
        $instituciones = DB::table('instituciones')->pluck('name', 'id');
        $paquetes = DB::table('paquetes')->pluck('name', 'id');
        $admins = DB::table('admins')->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.boletas.edit', compact('boleta', 'clientes', 'categorias', 'instituciones', 'paquetes', 'admins'));
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
        
        return view('admin.boletas.partials.mostrarCursos', compact('boleta'));
    }

    public function borrarCursos(Request $request, Contratado $curso){

        $curso->delete();
        return view('admin.boletas.partials.mostrarCursos', ['boleta' => Boleta::find($curso->boleta_id)]);
        /* return view('admin.boletas.cursos.index', ['boleta' => Boleta::find($curso->boleta_id)]); */
        
    }

    public function generarPDF(Boleta $boleta){

        $boleta->estado = "DESCARGADO";
        $boleta->save();
      
        $pdf = resolve('dompdf.wrapper');
        $pdf = PDF::loadView('admin.boletas.partials.pdf', compact('boleta'))->setPaper('a4', 'landscape');
        return $pdf->stream();

    }
}
