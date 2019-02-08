@extends('adminlte::page')

@section('title', 'Gestión - Localidades')

@section('content_header')

    <h1>
      Gestionar Localidades
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('localidades.index')}}">Localidades</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Localidad</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($localidad, ['route' => ['localidades.update', $localidad->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.localidades.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection


@push('js')
  <script type="text/javascript">
      
      var provinciaupdate_id = "<?php echo $localidad->departamento->provincia->id; ?>";
      $("#provincia_id").val(provinciaupdate_id);

  </script>

@endpush