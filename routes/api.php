<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;



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
        
        $clientes = DB::table('clientes')->select("id", "name", "telefono", "direccion")->get();

        return datatables()
                ->of($clientes)
                ->addColumn('btn', 'admin/clientes/actions')
                ->rawColumns(['btn'])
                ->toJson();
    });


    Route::get('boletas', function () {

        $boletas = App\Boleta::select("id", "cliente_id", "admin_id", "categoria_id", "estado")->get();

        foreach ($boletas as $boleta){
            $dato = [
                "id" => $boleta->id,
                "cliente" => $boleta->cliente->name,
                "coordinadora" => $boleta->admin->name,
                "categoria" => $boleta->categoria->name,
                "estado" => estadoBoletas($boleta->estado),
                "estado2" => $boleta->estado
            ];
            $datos[] = $dato;
        }
        
        return datatables()
                ->of($datos)
                ->addColumn('btn', 'admin/boletas/actions')
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
