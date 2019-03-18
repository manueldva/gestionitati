@extends('layouts.contenedor_contrato')

@section('estilo')
  <style> 
    .clausulas {
      margin-top:5px;
      font-size:12px;
      font-family: Arial, Helvetica;
    }

    .encabezado_titulo {
      margin-top:10px;
      font-size:13px;
      font-family: Arial, Helvetica;
    }

    .salto_pagina {
      page-break-after: always;
    }
  </style>
@stop

@section('cuerpo')


  <div class='clausulas'>
      {!! $contrato !!}
  </div>
@stop