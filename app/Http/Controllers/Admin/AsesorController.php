<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Asesor;
use App\Asesoria;

class AsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.asesores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asesores.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:asesors',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Asesor::create($request->all());

        return redirect()->route('asesores.index')
                ->with('info', 'Nuevo asesor creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Asesor $asesor)
    {
        $desde = Carbon::createFromFormat( 'd/m/Y', '01/05/2020', 'GMT');
        $hasta = Carbon::createFromFormat( 'd/m/Y', '08/05/2020', 'GMT');

        $name = $asesor->name;
        $id = $asesor->id;

        $asesorias = Asesoria::where('asesor_id', $asesor->id)
                            /* ->whereDate('fecha', '>=', $desde)
                            ->whereDate('fecha', '<=', $hasta) */
                            ->orderBy('fecha', 'ASC')
                            ->get();

        /* $asesorias = Asesoria::orderBy('fecha', 'ASC')
                        ->where('asesor_id', $asesor)
                        ->whereDate('fecha', $fecha)
                        ->paginate(10); */
        
        return view('admin.asesores.show', compact('asesorias', 'name', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asesor $asesor)
    {
        return view('admin.asesores.edit', compact('asesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asesor $asesor)
    {
        return $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asesor $asesor)
    {
        $asesor->delete();
    }
}
