<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

use App\Models\Articulo;
use App\Models\Tipoarticulo;
use App\Models\Articuloplandetalle;

use App\Models\Tipoprecio;
use App\Models\Tipoenvase;
use App\Models\Contratoarticulo;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;
use Validator;
use Alert;

use App\Helpers\FechaHelper;

class ArticuloController extends Controller
{
    const IMG_PATH = 'image/articulos/';
    const IMG_WIDTH = 400;
    const IMG_HEIGHT = 400;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'ARTICULO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
    

        $articulos = Articulo::type($request->get('type'), $request->get('val'), $request->get('tipoarticulo'))->paginate(15);

        /*foreach($articulos as $articulo){
            $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 
        }*/

        $articulos->setPath('articulos');

         //dd($motivos);
        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.index', compact('articulos', 'permiso', 'tipoarticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipoenvases  = Tipoenvase::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipoprecios  = Tipoprecio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $planarticulos  = Articulo::where('tipoarticulo_id', 1)->where('estado', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.create', compact('tipoarticulos', 'planarticulos', 'tipoprecios', 'tipoenvases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $articulo = Articulo::create($request->all());

        //auditoria
        $articulo->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();

        if($request->get('tipoarticulo_id') == '1'){ // 1 = articulo

            $listado_precios_text = $request->input("listado_precios");
        
            $listado_precios_array = explode('&&&', $listado_precios_text);
            array_pop($listado_precios_array);

            foreach ($listado_precios_array as $precio_text)
            {
                list($tipoprecio_id, $precio) = explode('|', $precio_text);
                
                //alert($direccion_id);
                if($tipoprecio_id == 1) //precio venta
                {
                    $articulo->precioventa = $precio;
                    $articulo->save();
                } else if ($tipoprecio_id == 2) // precio con reparto
                {
                    $articulo->precioreparto = $precio;
                    $articulo->save();
                } else if ($tipoprecio_id == 3) // precio sucursal
                {
                    $articulo->preciosucursal = $precio;
                    $articulo->save();
                
                } else if ($tipoprecio_id == 4) // precio herradura
                {
                    $articulo->precioherradura = $precio;
                    $articulo->save();
                }else if ($tipoprecio_id == 5) // precio mojon
                {
                    $articulo->preciomojon = $precio;
                    $articulo->save();
                }
            }

        } else if($request->get('tipoarticulo_id') == '2'){ // 2 = plan

            //$art_plan = Articuloplandetalle::where('plan_id', $id)->delete();

            $listado_planarticulos_text = $request->input("listado_planarticulos");
        
            $listado_planarticulos_array = explode('&&&', $listado_planarticulos_text);
            array_pop($listado_planarticulos_array);

            foreach ($listado_planarticulos_array as $planarticulo_text)
            {
                list($articulo_id, $cantidad) = explode('|', $planarticulo_text);
                
                $planarticulo = new Articuloplandetalle();
                    $planarticulo->plan_id = $articulo->id;
                    $planarticulo->planarticulo_id = $articulo_id;
                    $planarticulo->cantidad = $cantidad;
                    $planarticulo->usuario_alta = Auth::user()->username;
                    $planarticulo->fecha_alta = date('Y-m-d H:i:s');

                $planarticulo->save();
            }
        } else if($request->get('tipoarticulo_id') == '3'){ // 3 = insumo
            $articulo->clasificacion =  1;
            $articulo->save();
        }
        //

        //para imagenes
        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if (!$validator->fails())
            {
                //return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
                  //IMAGE 
                if($request->file('image')){
                    Image::make($request->file('image'))
                        ->resize(self::IMG_WIDTH,self::IMG_HEIGHT)
                        ->save(self::IMG_PATH . $articulo->id . '.jpg');

                    $articulo->fill(['file' => self::IMG_PATH . $articulo->id . '.jpg'])->save();
                }

            }
        } 

        /*//eliminar imagen
        if($request->input('eliminarimagen'))
        {
            $articulo->fill(['file' => null])->save();
        }
        //*/

        //
        Alert::success('Producto creado con exito')->persistent("Cerrar");
        //return redirect()->route('articulos.index');
        return redirect()->route('articulos.edit', $articulo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleprecios = [];
        $detalleplanes =[];

        $articulo = Articulo::find($id);

        //dd($detalleprecios);

        if($articulo->tipoarticulo_id == 1){  // 1 = articulo
            if($articulo->precioventa !== '' && $articulo->precioventa !== null && $articulo->precioventa !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '1' , 'tipoprecio'=> 'Precio Venta', 'precio' => $articulo->precioventa ];
            }

            if($articulo->precioreparto !== '' && $articulo->precioreparto !== null && $articulo->precioreparto !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '2', 'tipoprecio'=> 'Precio con Reparto', 'precio' => $articulo->precioreparto ];
            }

            if($articulo->preciosucursal  !== '' && $articulo->preciosucursal !== null && $articulo->preciosucursal !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '3', 'tipoprecio'=> 'Precio Sucursal', 'precio' => $articulo->preciosucursal ];
            }
            if($articulo->precioherradura  !== '' && $articulo->precioherradura !== null && $articulo->precioherradura !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '4', 'tipoprecio'=> 'Precio Herradura', 'precio' => $articulo->precioherradura ];
            }
            if($articulo->preciomojon  !== '' && $articulo->preciomojon !== null && $articulo->preciomojon !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '5', 'tipoprecio'=> 'Precio Mojon F.', 'precio' => $articulo->preciomojon ];
            }

            
        } if($articulo->tipoarticulo_id == 2){  // 2 = plan

            $art_plan = Articuloplandetalle::where('plan_id', $id)->get();
            if($art_plan) {
                foreach ($art_plan as $art_p) {
                    
                    $arttemp = Articulo::find($art_p->planarticulo_id);

                    $detalleplanes[] = ['articulo_id' => $art_p->planarticulo_id , 'articulo'=> $arttemp->descripcion , 'cantidad' => $art_p->cantidad ];
                }
            }
            
        }

       //dd($detalleplanes);

        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoenvases  = Tipoenvase::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipoprecios  = Tipoprecio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $planarticulos  = Articulo::where('tipoarticulo_id', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.show', compact('articulo','planarticulos' , 'tipoarticulos', 'tipoenvases', 'tipoprecios', 'detalleprecios', 'detalleplanes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $detalleprecios = [];
        $detalleplanes =[];

        $articulo = Articulo::find($id);

        //dd($detalleprecios);

        if($articulo->tipoarticulo_id == 1){  // 1 = articulo

            if($articulo->precioventa !== '' && $articulo->precioventa !== null && $articulo->precioventa !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '1' , 'tipoprecio'=> 'Precio Venta', 'precio' => $articulo->precioventa ];
            }

            if($articulo->precioreparto !== '' && $articulo->precioreparto !== null && $articulo->precioreparto !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '2', 'tipoprecio'=> 'Precio con Reparto', 'precio' => $articulo->precioreparto ];
            }

            if($articulo->preciosucursal  !== '' && $articulo->preciosucursal !== null && $articulo->preciosucursal !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '3', 'tipoprecio'=> 'Precio Sucursal', 'precio' => $articulo->preciosucursal ];
            }
            if($articulo->precioherradura  !== '' && $articulo->precioherradura !== null && $articulo->precioherradura !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '4', 'tipoprecio'=> 'Precio Herradura', 'precio' => $articulo->precioherradura ];
            }
            if($articulo->preciomojon  !== '' && $articulo->preciomojon !== null && $articulo->preciomojon !== '0.00') 
            {
                $detalleprecios[] = ['tipoprecio_id' => '5', 'tipoprecio'=> 'Precio Mojon F.', 'precio' => $articulo->preciomojon ];
            }

            
        } if($articulo->tipoarticulo_id == 2){  // 2 = plan

            $art_plan = Articuloplandetalle::where('plan_id', $id)->get();
            if($art_plan) {
                foreach ($art_plan as $art_p) {
                    
                    $arttemp = Articulo::find($art_p->planarticulo_id);

                    $detalleplanes[] = ['articulo_id' => $art_p->planarticulo_id , 'articulo'=> $arttemp->descripcion , 'cantidad' => $art_p->cantidad ];
                }
            }
            
        }

       //dd($detalleplanes);

        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoenvases  = Tipoenvase::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipoprecios  = Tipoprecio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $planarticulos  = Articulo::where('tipoarticulo_id', 1)->where('estado', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.edit', compact('articulo','planarticulos' , 'tipoarticulos', 'tipoenvases', 'tipoprecios', 'detalleprecios', 'detalleplanes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //dd($request->all());

        $articulo = Articulo::find($id);

        $articulo->fill($request->all())->save();


        //auditoria
        $articulo->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        if($request->get('tipoarticulo_id') == '1'){ // 1 = articulo

            $listado_precios_text = $request->input("listado_precios");
        
            $listado_precios_array = explode('&&&', $listado_precios_text);
            array_pop($listado_precios_array);

            $articulo->precioventa = null;
            $articulo->precioreparto = null;
            $articulo->preciosucursal = null;
            $articulo->precioherradura   = null;
            $articulo->save();
            
            foreach ($listado_precios_array as $precio_text)
            {
                list($tipoprecio_id, $precio) = explode('|', $precio_text);
                
                //alert($direccion_id);
                if($tipoprecio_id == 1) //precio venta
                {
                    $articulo->precioventa = $precio;
                    $articulo->save();
                } else if ($tipoprecio_id == 2) // precio con reparto
                {
                    $articulo->precioreparto = $precio;
                    $articulo->save();
                } else if ($tipoprecio_id == 3) // precio sucursal
                {
                    $articulo->preciosucursal = $precio;
                    $articulo->save();
                
                } else if ($tipoprecio_id == 4) // precio herradura
                {
                    $articulo->precioherradura = $precio;
                    $articulo->save();
                }else if ($tipoprecio_id == 5) // precio mojon
                {
                    $articulo->preciomojon = $precio;
                    $articulo->save();
                }
            }

        } else if($request->get('tipoarticulo_id') == '2'){ // 2 = plan

            $art_plan = Articuloplandetalle::where('plan_id', $id)->delete();

            $listado_planarticulos_text = $request->input("listado_planarticulos");
        
            $listado_planarticulos_array = explode('&&&', $listado_planarticulos_text);
            array_pop($listado_planarticulos_array);

            foreach ($listado_planarticulos_array as $planarticulo_text)
            {
                list($articulo_id, $cantidad) = explode('|', $planarticulo_text);
                
                $planarticulo = new Articuloplandetalle();
                    $planarticulo->plan_id = $id;
                    $planarticulo->planarticulo_id = $articulo_id;
                    $planarticulo->cantidad = $cantidad;
                    $planarticulo->usuario_alta = Auth::user()->username;
                    $planarticulo->fecha_alta = date('Y-m-d H:i:s');

                $planarticulo->save();
            }
        } else if($request->get('tipoarticulo_id') == '3'){ // 3 = insumo4
            $articulo->clasificacion =  1;
            $articulo->save();
        }

         //para imagenes
        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if (!$validator->fails())
            {
                //return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
                  //IMAGE 
                if($request->file('image')){
                    Image::make($request->file('image'))
                        ->resize(self::IMG_WIDTH,self::IMG_HEIGHT)
                        ->save(self::IMG_PATH . $articulo->id . '.jpg');

                    $articulo->fill(['file' => self::IMG_PATH . $articulo->id . '.jpg'])->save();
                }

            }
        } 

        //eliminar imagen
        if($request->input('deleteimage') == '1')
        {
            $articulo->fill(['file' => null])->save();
        }
        //



        Alert::success('Producto actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('articulos.index');
        return redirect()->route('articulos.edit', $articulo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Contratoarticulo::where('articulo_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        /*$existe = Articuloplandetalle::where('plan_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/

        Articuloplandetalle::where('plan_id', $id)->delete();
        Articulo::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
