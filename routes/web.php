<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/detalleinformecontratos', 'HomeController@detalleinformecontratos')->name('detalleinformecontratos');
route::get('/detalleinformecontratoprint/{barrio}',		'Admin\InformeController@detalleinformecontratoprint')->name('detalleinformecontratoprint');
route::get('/detalleclienteprint/{barrio}',		'Admin\InformeController@detalleclienteprint')->name('detalleclienteprint');

Route::get('/informecontratosbarriosarticulos', 'HomeController@informecontratosbarriosarticulos')->name('informecontratosbarriosarticulos');
route::get('/informecontratosbarriosarticulosprint/{barrio}/{articulo}',		'Admin\InformeController@informecontratosbarriosarticulosprint')->name('informecontratosbarriosarticulosprint');


/*Route::get('/detallemistareasabiertas', 'HomeController@detallemistareasabiertas')->name('detallemistareasabiertas');
Route::get('/detalleotrastareasabiertas', 'HomeController@detalleotrastareasabiertas')->name('detalleotrastareasabiertas');*/


//

/*
Route::get('autocompleteempleado', function() {
     $data = App\Models\Empleado::select("empleado")
            ->where('empleado', 'LIKE', '%' . request('q') . '%')
            ->get();

    return response()->json($data);
});
*/

//menu principal
route::resource('clientes', 		'Admin\ClienteController');
route::get('/editdireccion/{id}',		'Admin\ClienteController@editdireccion')->name('editdireccion');
route::put('/updatedireccion/{id}',		'Admin\ClienteController@updatedireccion')->name('updatedireccion');
route::resource('cuentacorrientes', 		'Admin\CuentacorrienteController');
route::resource('articulos', 		'Admin\ArticuloController');
route::resource('empleados', 		'Admin\EmpleadoController');
route::get('/empleadotransferir/{id}',		'Admin\EmpleadoController@empleadotransferir')->name('empleadotransferir');
route::post('/empleadotransferirstore',		'Admin\EmpleadoController@empleadotransferirstore')->name('empleadotransferirstore');
route::resource('modelocontratos', 	'Admin\ModelocontratoController');
route::resource('contratos', 		'Admin\ContratoController');
route::get('/eliminarcontrato/{id}',		'Admin\ContratoController@eliminar')->name('eliminarcontrato');
Route::get('/printcontrato/{id}', 'Admin\ContratoController@printcontrato');
route::resource('stocks', 		'Admin\StockController');
route::resource('stockajustes', 		'Admin\StockajusteController');

route::get('/showajusteventa/{id}',		'Admin\StockajusteController@showajusteventa')->name('showajusteventa');
route::put('/updateajusteventa/{id}',		'Admin\StockajusteController@updateajusteventa')->name('updateajusteventa');

route::resource('stockasignaciones', 		'Admin\AsignarStockController');
Route::get('/printstocksignacion/{id}/{carga}', 'Admin\AsignarStockController@printstocksignacion');
route::resource('hojarutas', 		'Admin\HojarutaController');
route::get('/cobranza/{id}',		'Admin\HojarutaController@cobranza')->name('cobranza');
route::put('/updatecobranza/{id}',		'Admin\HojarutaController@updatecobranza')->name('updatecobranza');
Route::get('/printhojaruta/{id}', 'Admin\HojarutaController@printhojaruta');
route::get('/printhojarutadetalle/{id}/{fecha}',		'Admin\HojarutaController@printhojarutadetalle')->name('printhojarutadetalle');

route::resource('hojarutaarticulos', 		'Admin\HojarutaarticuloController');
Route::get('/printhojarutaarticulo/{id}', 'Admin\HojarutaarticuloController@printhojarutaarticulo');

route::resource('ventas', 		'Admin\VentaController');
route::resource('gastos', 	'Admin\GastosController');

/*route::resource('tareas', 		'Admin\TareaController');
route::get('/TA_obtenerbases/{id}',		'Admin\TareaController@TA_obtenerbases')->name('TA_obtenerbases');*/
route::resource('informes', 		'Admin\InformeController');
route::get('/informevendedorgeneralprint/{usuario}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informevendedorgeneralprint')->name('informevendedorgeneralprint');

route::get('/informevendedorstockprint/{usuario}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informevendedorstockprint')->name('informevendedorstockprint');

route::get('/informeventaoficinaprint/{usuario}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informeventaoficinaprint')->name('informeventaoficinaprint');

route::get('/informesincomprarprint/{usuario}/{tipo}',		'Admin\InformeController@informesincomprarprint')->name('informesincomprarprint');

route::get('/informemovimientoclienteprint/{cliente_id}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informemovimientoclienteprint')->name('informemovimientoclienteprint');

//seguridad
route::resource('modulos', 		'Admin\ModuloController');
route::resource('perfiles', 	'Admin\PerfilController');
Route::get('/asignarmodulo/{id}', 'Admin\PerfilController@asignarmodulo');
Route::post('/guardarpermisos/{id}', 'Admin\PerfilController@guardarpermisos');


route::resource('manageusers', 		'Admin\ManageuserController');
route::get('/showSetting/{id}',		'Admin\ManageuserController@showSetting')->name('showSetting');
route::put('/setting/{id}',		'Admin\ManageuserController@setting')->name('setting');
//

//

// complementos
route::resource('provincias', 		'Admin\Complementos\ProvinciaController');
route::resource('departamentos', 		'Admin\Complementos\DepartamentoController');
route::resource('localidades', 		'Admin\Complementos\LocalidadController');
route::resource('distritos', 		'Admin\Complementos\DistritoController');
route::resource('barrios', 		'Admin\Complementos\BarrioController');
route::resource('calles', 		'Admin\Complementos\CalleController');
route::resource('tipoivas', 		'Admin\Complementos\TipoivaController');
route::resource('tipoempleados', 		'Admin\Complementos\TipoempleadoController');
route::resource('tipofamiliares', 		'Admin\Complementos\TipofamiliarController');
route::resource('companiatelefonicas', 		'Admin\Complementos\CompaniatelefonicaController');
route::resource('sucursales', 		'Admin\Complementos\SucursalController');
route::resource('tipocomprobantes', 		'Admin\Complementos\TipocomprobanteController');
route::resource('rubrogastos', 		'Admin\Complementos\RubrogastoController');
route::resource('proveedorgastos', 		'Admin\Complementos\ProveedorgastoController');


// servicios
Route::get('/habilitarmodulos/{user}', 'Service\ServiceController@habilitarmodulos')->name('habilitarmodulos');
//

