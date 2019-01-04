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


//admin
route::resource('manageusers', 		'Admin\ManageuserController');
route::get('/showSetting/{id}',		'Admin\ManageuserController@showSetting')->name('showSetting');
route::put('/setting/{id}',		'Admin\ManageuserController@setting')->name('setting');
//

//menu principal
/*route::resource('tareas', 		'Admin\TareaController');
route::get('/TA_obtenerbases/{id}',		'Admin\TareaController@TA_obtenerbases')->name('TA_obtenerbases');
route::resource('informes', 		'Admin\InformeController');
route::get('/informeprint/{usuario}/{fechadesde}/{fechahasta}',		'Admin\InformeController@informeprint')->name('informeprint');*/
route::resource('ventas', 		'Admin\VentaController');
route::resource('proveedores', 		'Admin\ProveedorController');
route::resource('articulos', 		'Admin\ArticuloController');
//

// complementos
route::resource('rubros', 		'Admin\Complementos\RubroController');
/*route::resource('servidores', 		'Admin\Complementos\ServidorController');
route::resource('bases', 		'Admin\Complementos\BaseController');*/