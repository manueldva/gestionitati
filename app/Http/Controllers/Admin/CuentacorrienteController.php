<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;
use DB;

use App\Models\Modulo;
use App\Models\Perfil;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Models\Cuentacorriente;
use App\Models\Cuentacorrientedetalle;
use App\Models\Cliente;
use Auth;

use App\Helpers\FechaHelper;

use Barryvdh\DomPDF\Facade as PDF;

class CuentacorrienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        $cuentacorriente = Cuentacorriente::where('cliente_id', $cliente->id)->first();

        $permitirpago = 1;
        if($cuentacorriente){
            $deuda = $cuentacorriente->monto;
            $cuentacorrientedetalles = Cuentacorrientedetalle::where('cuentacorriente_id', $cuentacorriente->id)->get();
            if(count($cuentacorrientedetalles) == 0){
                $permitirpago = 0;
            }
        } else {
            $deuda = 0;
            $cuentacorrientedetalles = [];
            $permitirpago = 0;
        }

        foreach ($cuentacorrientedetalles as $cuenta) {
            $cuenta->fechapago = FechaHelper::getFechaImpresion($cuenta->fechapago); 
        }


        return view('admin.cuentacorrientes.edit',compact('cliente', 'cuentacorrientedetalles', 'permitirpago', 'deuda'));
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
        
        $cuentacorriente = Cuentacorriente::where('cliente_id', $id)->first();

        if(!$cuentacorriente) {
            $cuentacorriente = new Cuentacorriente();
                $cuentacorriente->cliente_id = $id;
                $cuentacorriente->monto = 0;
                $cuentacorriente->usuario_alta = Auth::user()->username;
                $cuentacorriente->fecha_alta = date('Y-m-d H:i:s');
            $cuentacorriente->save();
        }

        $cuentacorrientedetalle = Cuentacorrientedetalle::create($request->all());
         //auditoria
        $cuentacorrientedetalle->fill(['cuentacorriente_id'=> $cuentacorriente->id, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
         //
        if($cuentacorrientedetalle->tipopago == 1) {
            $cuentacorriente->monto = $cuentacorrientedetalle->monto + $cuentacorriente->monto;
        } else {
            $cuentacorriente->monto = $cuentacorriente->monto - $cuentacorrientedetalle->monto;
        }
        $cuentacorriente->save();

         
        Alert::success('Cuenta corriente actualizada correctamente')->persistent("Cerrar");
        return redirect()->route('cuentacorrientes.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
