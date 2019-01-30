<?php

use Illuminate\Http\Request;


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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('articulos', function() {

    return App\Models\Articulo::where('descripcion', 'LIKE', '%' . request('q') . '%')->paginate(10);
});


Route::get('localidades', function() {

    return App\Models\Localidad::where('provincia_id', '=', request('provincia_id'))->get();
});

Route::get('barrios', function() {

    return App\Models\Barrio::where('localidad_id', '=', request('localidad_id'))->get();
});
Route::get('calles', function() {

    return App\Models\Calle::where('localidad_id', '=', request('localidad_id'))->get();
});



/*se usa para validar si existe o no un cliente con este numerodocumento*/
Route::get('validardocumento', function() {
    $cliente = App\Models\Cliente::where('numerodocumento', '=', request('q'))->where('tipodocumento_id', '=', request('t'))->first();
    if($cliente){
    	$id = $cliente->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});


/*para buscar empleado*/

Route::get('autocompleteempleadodesc', function() {

    $tipoempleado = App\Models\Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
    $empleados = App\Models\Empleado::where('empleado', 'LIKE', '%' . request('q') . '%')->where('tipoempleado_id', '=', $tipoempleado->id)->paginate(10);

    return $empleados;
});


