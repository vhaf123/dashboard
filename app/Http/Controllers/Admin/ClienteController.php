<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Cliente;
use App\Timeline;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
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
            'name' => 'required',
            'telefono' => 'required|regex:/[0-9]/|min:7|max:9',
            'dni' => 'required|regex:/[0-9]/|min:8|max:8',
            'direccion' => 'required',
            'distrito' => 'required',
            'referencia' => 'required',
        ]);

        $cliente = Cliente::create($request->all());

        Timeline::create([
            'cliente_id' => $cliente->id,
            'accion' => 'create_cliente',
            'accion_id' => $cliente->id
        ]);
        

        return redirect()->route('admin.clientes.show', $cliente)
                ->with('info', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {

        $timelines = Timeline::where('cliente_id', $cliente->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('admin.clientes.show', compact('cliente', 'timelines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.clientes.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'name' => 'required',
            'telefono' => 'required|regex:/[0-9]/|min:7|max:9',
            'dni' => 'required|regex:/[0-9]/|min:8|max:8',
            'direccion' => 'required',
            'distrito' => 'required',
            'referencia' => 'required',
        ]);

        $cliente->fill($request->all())->save();

        Timeline::create([
            'cliente_id' => $cliente->id,
            'accion' => 'update_cliente',
            'accion_id' => $cliente->id
        ]);
        

        return redirect()->route('admin.clientes.show', $cliente)
                ->with('info', 'Cliente creado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
