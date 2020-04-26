<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'admin_id' => \Auth::guard('admin')->user()->id,
            'accion' => 'create_cliente',
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

        $categorias = DB::table('categorias')->orderBy('name', 'ASC')->pluck('name', 'id');
        $instituciones = DB::table('instituciones')->pluck('name', 'id');
        $paquetes = DB::table('paquetes')->pluck('name', 'id');
        $admins = DB::table('admins')->orderBy('name', 'ASC')->pluck('name', 'id');
        
        return view('admin.clientes.show', compact('cliente', 'timelines', 'categorias', 'instituciones', 'paquetes', 'admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
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
            'admin_id' => \Auth::guard('admin')->user()->id,
            'accion' => 'update_cliente',
        ]);
        

        return redirect()->route('admin.clientes.show', $cliente)
                ->with('info', 'Información del cliente ' . $cliente->name . ' actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }
}
