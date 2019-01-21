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


Route::get('departamentos', function() {

    return App\Models\Departamento::where('provincia_id', '=', request('provincia_id'))->get();
});


/*se usa para validar si existe o no un cliente con este numerodocumento*/
Route::get('validardocumento', function() {
    $cliente = App\Models\Cliente::where('numerodocumento', '=', request('q'))->first();
    if($cliente){
    	$id = $cliente->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});


Route::get('autocompleteempleadodesc', function() {

    return App\Models\Empleado::where('empleado', 'LIKE', '%' . request('q') . '%')->paginate(10);
});
