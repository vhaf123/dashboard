<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\Asesor;
use App\Asesoria;


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

        if(count($clientes) == 0){
            return datatables()
                ->of($clientes)
                ->toJson();
        }else{

            return datatables()
                    ->of($clientes)
                    ->addColumn('btn', 'admin/clientes/actions')
                    ->rawColumns(['btn'])
                    ->toJson();
        }
    });

    Route::get('asesores', function () {

        $asesores = DB::table('asesors')->select("id", "email", "name")->get();

        if(count($asesores) == 0){
            return datatables()
                ->of($asesores)
                ->toJson();
        }else{

            return datatables()
                ->of($asesores)
                ->addColumn('btn', 'admin/asesores/partials/actions')
                ->rawColumns(['btn'])
                ->toJson();
        }
    });

    Route::get('boletas', function () {

        $boletas = App\Boleta::select("id", "cliente_id", "admin_id", "categoria_id", "estado")
                                ->orderBy('id', 'DESC')
                                ->get();

        if(count($boletas) == 0){
            return datatables()
                ->of($boletas)
                ->toJson();
        }else{

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
        }
    });

    Route::get('paquetes/pendientes', function () {

        $contratados = App\Contratado::where('generado', 0)->orderBy('id', 'DESC')->get();

        if(count($contratados) == 0){
            
            return datatables()
                ->of($contratados)
                ->toJson();
        }else{

            foreach ($contratados as $contratado){

                $dato = [
                    'id' => $contratado->id,
                    "boleta" => $contratado->boleta_id,
                    "cliente" => $contratado->boleta->cliente->name,
                    "curso" => $contratado->curso->name,
                    "nivel" => $contratado->nivel->name,
                    'inicio' => primerDia($contratado->dias, $contratado->boleta->inicio, $contratado->boleta->culminacion)->toFormattedDateString(),
                    'culminacion' => ultimoDia($contratado->dias, $contratado->boleta->inicio, $contratado->boleta->culminacion)->toFormattedDateString(),
                    'horario' => horario($contratado->h_inicio, $contratado->h_final),
                    'dias' => $contratado->dias,
                ];
                        
                $datos[] = $dato;
            }

            return datatables()
                ->of($datos)
                ->addColumn('btn', 'admin/paquetes/partials/actions')
                ->rawColumns(['btn'])
                ->toJson();
        }

    });

    /* Route::get('admin/asesores/{id}', function (Request $request, $id) {

        $fechas = $request->get('fechas');

        if($fechas){
            $fechas = explode(' - ', $request->get('fechas'));
            $desde = Carbon::createFromFormat( 'd/m/Y', $fechas[0], 'GMT');
            $hasta = Carbon::createFromFormat( 'd/m/Y', $fechas[1], 'GMT');
        } else{
            $desde = null;
            $hasta = null;
        }

        $asesorias = Asesoria::where('asesor_id', $id)
                            ->desde($desde)
                            ->hasta($hasta)
                            ->orderBy('fecha', 'ASC')
                            ->get();

        if(count($asesorias) == 0){
            return datatables()
                ->of($asesorias)
                ->toJson();
        } else{
            foreach($asesorias as $asesoria){
                $dato = [
                    'asesoria' => $asesoria->id,
                    'admin' => $asesoria->boleta->admin_id,
                    'boleta' => $asesoria->boleta_id,
                    'cliente' => $asesoria->boleta->cliente->name,
                    'categoria' => $asesoria->boleta->categoria->name,
                    'fecha' => $asesoria->fecha->format('d/m/Y'),
                    'horario' => horario($asesoria->h_inicio, $asesoria->h_final),
                    'duracion' => duracion($asesoria->duracion)
                ];

                $datos[] = $dato;
            }

            return datatables()
                ->of($datos)
                ->addColumn('btn', 'admin/asesores/partials/actions2')
                ->rawColumns(['btn'])
                ->toJson();
        }

    }); */

    Route::get('coordinadores', function () {

        $admins = App\Models\Admin::select('id', 'name')->get();

        if(count($admins) == 0){
            
            return datatables()
                ->of($admins)
                ->toJson();
        }else{

            return datatables()
                ->of($admins)
                ->addColumn('btn', 'admin/coordinadores/partials/actions')
                ->rawColumns(['btn'])
                ->toJson();
        }

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
