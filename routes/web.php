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
/*Route::get('/detallemistareasabiertas', 'HomeController@detallemistareasabiertas')->name('detallemistareasabiertas');
Route::get('/detalleotrastareasabiertas', 'HomeController@detalleotrastareasabiertas')->name('detalleotrastareasabiertas');*/


//


Route::get('autocompleteempleado', function() {
     $data = App\Models\Empleado::select("empleado")
            ->where('empleado', 'LIKE', '%' . request('q') . '%')
            ->get();

    return response()->json($data);
});


//menu principal
route::resource('clientes', 		'Admin\ClienteController');
/*route::resource('tareas', 		'Admin\TareaController');
route::get('/TA_obtenerbases/{id}',		'Admin\TareaController@TA_obtenerbases')->name('TA_obtenerbases');
route::resource('informes', 		'Admin\InformeController');
route::get('/informeprint/{usuario}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informeprint')->name('informeprint');*/

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
route::resource('calles', 		'Admin\Complementos\CalleController');

// servicios
Route::get('/habilitarmodulos/{user}', 'Service\ServiceController@habilitarmodulos')->name('habilitarmodulos');
//

