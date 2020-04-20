<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Models\Asesor;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* Datatable */
    Route::get('clientes', function () {
        
        $clientes = DB::table('clientes')->select("id", "name", "telefono", "direccion")->orderBy('id', 'DESC')->get();

        return datatables()
                ->of($clientes)
                ->addColumn('btn', 'admin/clientes/actions')
                ->rawColumns(['btn'])
                ->toJson();
    });

    Route::get('asesores', function () {

        $asesores = DB::table('asesors')->select("id", "email", "name")->get();

        return datatables()
            ->of($asesores)
            ->addColumn('btn', 'admin/asesores/partials/actions')
            ->rawColumns(['btn'])
            ->toJson();
    });

    Route::get('boletas', function () {

        $boletas = App\Boleta::select("id", "cliente_id", "admin_id", "categoria_id", "estado")->orderBy('id', 'DESC')->get();

        foreach ($boletas as $boleta){
            $dato = [
                "id" => $boleta->id,
                "cliente" => $boleta->cliente->name,
                "coordinadora" => $boleta->admin->name,
                "categoria" => $boleta->categoria->name,
                "estado" => $boleta->estado
            ];
            $datos[] = $dato;
        }
        
        return datatables()
                ->of($datos)
                ->addColumn('btn', 'admin/boletas/partials/actions')
                ->addColumn('estado', 'admin/boletas/partials/estados')
                ->rawColumns(['btn', 'estado'])
                ->toJson();

    });

/* select2 */
    Route::get('select2/clientes', function (Request $request) {

        $term = $request->term ?: '';
        $clientes = DB::table('clientes')->where('name', 'like', $term.'%')->select('id', 'name')->orderBy('name', 'ASC')->get();

        foreach($clientes as $cliente){
            $valid_tags[] = [
                'id' => $cliente->id,
                'text' => $cliente->name
            ];
        }

        return \Response::json($valid_tags);
        
    });
