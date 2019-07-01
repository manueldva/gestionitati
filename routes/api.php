<?php

use Illuminate\Http\Request;
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

Route::get('planarticulos', function() {

    $articulo = App\Models\Articulo::where('id', '=', request('q'))->where('tipoarticulo_id', '=' , 1)->first();
    if(!$articulo){
        $articulo = 0;
    }
    return $articulo;
});

Route::get('contratoarticulos', function() {

    $articulos = App\Models\Contratoarticulo::where('contrato_id', '=', request('q'))->get();
    if(!$articulos){
        $articulos = 0;
    }

    foreach ($articulos as $key => $value) {
        $value->usuario_alta = $value->articulo->descripcion;
    }
    return $articulos;
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
     $cliente = App\Models\Cliente::where('numerodocumento', '=', request('nrodocumento'))->where('tipodocumento_id', '=', request('tipodocumento_id'))->first();

    if($cliente) {
        $clientedireccion = App\Models\Clientedireccion::where('provincia_id', '=', request('provincia'))->where('departamento_id', '=', request('departamento'))->where('localidad_id', '=', request('localidad'))->where('barrio_id', '=', request('barrio'))->where('calle_id', '=', request('calle'))->where('manzana', '=', request('manzana'))->where('casa', '=', request('casa'))->where('numero', '=', request('numero'))->where('edificiotorre', '=', request('edificiotorre'))->where('piso', '=', request('piso'))->where('seccion', '=', request('seccion'))->where('lote', '=', request('lote'))->where('cliente_id', '<>', $cliente->id)->first();
    } else {
         $clientedireccion = App\Models\Clientedireccion::where('provincia_id', '=', request('provincia'))->where('departamento_id', '=', request('departamento'))->where('localidad_id', '=', request('localidad'))->where('barrio_id', '=', request('barrio'))->where('calle_id', '=', request('calle'))->where('manzana', '=', request('manzana'))->where('casa', '=', request('casa'))->where('numero', '=', request('numero'))->where('edificiotorre', '=', request('edificiotorre'))->where('piso', '=', request('piso'))->where('seccion', '=', request('seccion'))->where('lote', '=', request('lote'))->first();
    }  

    if($clientedireccion){
        $id = $clientedireccion->cliente_id;
    } else
    {
        $id = 0;
    }
    return $id;
});



Route::get('stockarticulodetalles', function() {

    $data = 0;
    $articulos = App\Models\Stockarticulodetalle::where('articulo_id', '=', request('q'))->get();
    if($articulos){
        $data = 1;
    }

    if($data == 1){
        $data = 0;
        foreach ($articulos as $value) {
           $stock = App\Models\Stockarticulo::where('id', '=', $value->stockarticulo_id)->first();         

           if($stock->sucursal_id == request('s')){
            $data = 1;
           }
        }
    }
    return $data;
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

/*Hoja de ruta*/
Route::get('hojaruta_barrios', function() {

    $query="select b.id, b.descripcion, b.localidad_id, l.descripcion localidad  from clientes c
        inner join clientedirecciones cd on c.id = cd.cliente_id
        inner join barrios b on b.id = cd.barrio_id
        inner join contratos co on cd.id = co.clientedireccion_id
        inner join localidades l on l.id = b.localidad_id
        where cd.empleado_id = " . request('empleado_id') . "  and c.estado = 1 and co.estado = 1
        group by  b.id, b.descripcion, b.localidad_id, l.descripcion
        order By b.descripcion; ";

    $data = DB::select($query);

    return $data;

});


Route::get('buscarruta', function() {

    $select_barrio = request('b');
    $barrios = implode(',', $select_barrio);


   
   /* $query="select c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad  
    from clientes c
    inner join clientedirecciones cd on c.id = cd.cliente_id
    inner join contratos co on cd.id = co.clientedireccion_id
    inner join contratoarticulos coart on co.id = coart.contrato_id
    inner join articulos a on coart.articulo_id = a.id
    left join calles ca on ca.id = cd.calle_id
    left join barrios ba on ba.id = cd.barrio_id
    where cd.empleado_id = " . request('e') . " and c.estado = 1 and co.estado = 1 and barrio_id in(" . $barrios . ")
    order by ca.descripcion DESC , ba.descripcion DESC , CAST(cd.numero AS INTEGER) DESC, cd.seccion DESC, CAST(cd.manzana AS INTEGER) DESC, CAST(cd.casa AS INTEGER) DESC, cd.edificiotorre DESC, cd.piso, cd.lote, cd.referenciadomicilio  DESC

    ";*/

     $query="select cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo, sum(cantidad) cantidad   
        from (select c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad  
    from clientes c
    inner join clientedirecciones cd on c.id = cd.cliente_id
    inner join contratos co on cd.id = co.clientedireccion_id
    inner join contratoarticulos coart on co.id = coart.contrato_id
    inner join articulos a on coart.articulo_id = a.id
    left join calles ca on ca.id = cd.calle_id
    left join barrios ba on ba.id = cd.barrio_id
    where cd.empleado_id = " . request('e') . " and c.estado = 1 and co.estado = 1 and barrio_id in(" . $barrios . ")
   ) as subconsulta
    group by cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo
    order by calle DESC , barrio DESC , CAST(numero AS INTEGER) DESC, seccion DESC, CAST(manzana AS INTEGER) DESC, CAST(casa AS INTEGER) DESC, edificiotorre DESC, piso, lote, referenciadomicilio  DESC";


    $data = DB::select($query);

    return $data;
});


Route::get('hojaruta_cant_docimicilios', function() {

    $select_barrio = request('b');
    $barrios = implode(',', $select_barrio);

    $query="select count(cd.id) cantidad from clientes c
        inner join clientedirecciones cd on c.id = cd.cliente_id
         inner join (
            select distinct(clientedireccion_id)  from contratos where  estado = 1 
            order by clientedireccion_id, fechacontrato desc
        ) as last_cotrato on cd.id = last_cotrato.clientedireccion_id
        where cd.empleado_id = " . request('e') . " and c.estado = 1 and barrio_id in(" . $barrios . ")";

    $data = DB::select($query);

    foreach ($data as $key => $value) {
       $cantidad = $value->cantidad;
    }
    return $cantidad;
});



Route::get('detalleclientehojaruta', function() {

   $query="select hrd.id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente,
        ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio,
        a.descripcion articulo, hrd.cantidad, a.clasificacion
        from hojarutas hr
        inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
        inner join clientes c on hrd.cliente_id = c.id
        inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
        left join calles ca on ca.id = cd.calle_id
        left join barrios ba on ba.id = cd.barrio_id
        inner join articulos a on hrd.articulo_id = a.id
        where hr.id = " . request('hoj') . " and hrd.estado = 1 and c.id = " . request('cli') . "
        order by hrd.id";

    $data = DB::select($query);
    
    if(!$data){
        $data = 0;
    }


    return $data;
});


/*--------------------*/

/*stock*/
Route::get('stockarticulos', function() {

    return App\Models\Stockarticulo::where('sucursal_id', '=', request('sucursal_id'))->orderBy('descripcion')->get();
});

Route::get('stockarticulo', function() {

    $stockarticulo = App\Models\Stockarticulo::where('id', '=', request('q'))->first();
    if(!$stockarticulo){
        $stockarticulo = 0;
    }
    return $stockarticulo;
});



/*----------*/