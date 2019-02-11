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

    $articulo = App\Models\Articulo::where('id', '=', request('q'))->first();
    if(!$articulo){
    	$articulo = 0;
    }
    return $articulo;
});


Route::get('departamentos', function() {

    return App\Models\Departamento::where('provincia_id', '=', request('provincia_id'))->orderBy('descripcion')->get();
});

//para complementos sin las localidades con campo sinbarrio marcado en 1
Route::get('localidades', function() {

    return App\Models\Localidad::where('departamento_id', '=', request('departamento_id'))->where('sinbarrio', 0)->orderBy('descripcion')->get();
});

//para clientes con todas las localidades
Route::get('localidadescli', function() {

    return App\Models\Localidad::where('departamento_id', '=', request('departamento_id'))->orderBy('descripcion')->get();
});

/*para validar si la localidad esta marcado como sin barrio */
Route::get('validarsinbarrio', function() {
    $localidad =  App\Models\Localidad::where('id', '=', request('q'))->first();
    if($localidad->sinbarrio == 1){
        $id = 1;
    } else
    {
        $id = 0;
    }
    return $id;
});


Route::get('barrios', function() {

    return App\Models\Barrio::where('localidad_id', '=', request('localidad_id'))->orderBy('descripcion')->get();
});

/*para validar si la localidad esta marcado como sin barrio */
Route::get('validarsincalle', function() {
    $barrio =  App\Models\Barrio::where('id', '=', request('q'))->first();
    if($barrio->sincalle == 1){
        $id = 1;
    } else
    {
        $id = 0;
    }
    return $id;
});


Route::get('calles', function() {

    return App\Models\Calle::where('localidad_id', '=', request('localidad_id'))->orderBy('descripcion')->get();
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


//buscar empleado vendedor por codigo
Route::get('buscarempleado', function() {
    $tipoempleado = App\Models\Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
    $empleado = App\Models\Empleado::where('id', '=', request('q'))->where('tipoempleado_id', '=', $tipoempleado->id)->first();
    if(!$empleado){
    	$empleado = 0;
    }
    return $empleado;
});


// verificar departamentos

Route::get('verificardepartamento', function() {
    $departamento = App\Models\Departamento::where('descripcion', '=', request('d'))->where('provincia_id', '=', request('p'))->first();
    if($departamento){
    	$id = $departamento->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});

Route::get('verificarlocalidad', function() {
    $localidad = App\Models\Localidad::where('descripcion', '=', request('d'))->where('departamento_id', '=', request('di'))->first();
    if($localidad){
    	$id = $localidad->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});

Route::get('verificarbarrio', function() {
    $barrio = App\Models\Barrio::where('descripcion', '=', request('d'))->where('localidad_id', '=', request('l'))->first();
    if($barrio){
    	$id = $barrio->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});

Route::get('verificarcalle', function() {
    $calle = App\Models\Calle::where('descripcion', '=', request('d'))->where('localidad_id', '=', request('l'))->first();
    if($calle){
    	$id = $calle->id;
    } else
    {
    	$id = 0;
    }
    return $id;
});



//validar direccion
Route::get('validardomicilioidentico', function() {

    $cliente = App\Models\Cliente::where('provincia_id', '=', request('provincia'))->where('departamento_id', '=', request('departamento'))->where('localidad_id', '=', request('localidad'))->where('barrio_id', '=', request('barrio'))->where('calle_id', '=', request('calle'))->where('manzana', '=', request('manzana'))->where('casa', '=', request('casa'))->where('numero', '=', request('numero'))->where('edificiotorre', '=', request('edificiotorre'))->where('piso', '=', request('piso'))->where('seccion', '=', request('seccion'))->where('lote', '=', request('lote'))->where('codigopostal', '=', request('codigopostal'))->where('numerodocumento', '<>', request('nrodocumento'))->first();

    if($cliente){
        $id = $cliente->id;
    } else
    {
        $id = 0;
    }
    return $id;
});

/*    $cliente = App\Models\Cliente::where('provincia_id', '=', request('provincia'))->where('departamento_id', '=', request('departamento')->where('localidad_id', '=', request('localidad'))->where('barrio_id', '=', request('barrio'))->where('calle_id', '=', request('calle'))->where('manzana', '=', request('manzana'))->where('casa', '=', request('casa'))->where('numero', '=', request('numero'))->where('edificiotorre', '=', request('edificiotorre'))->where('piso', '=', request('piso'))->where('seccion', '=', request('seccion'))->where('lote', '=', request('lote'))->where('codigopostal', '=', request('codigopostal'))->first();*/



/*para buscar empleado*/
/*
Route::get('autocompleteempleadodesc', function() {

    $tipoempleado = App\Models\Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
    $empleados = App\Models\Empleado::where('empleado', 'LIKE', '%' . request('q') . '%')->where('tipoempleado_id', '=', $tipoempleado->id)->paginate(10);

    return $empleados;
});

*/
