<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('localidades.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		{{ form::label('provincia_id', 'Provincia *') }}
		{{ form::select('provincia_id',$provincias, null, ['class' => 'form-control'] ) }} 
	</div>

	<div class="form-group">
		{{ form::label('departamento_id', 'Departamento *') }}
		{{ form::select('departamento_id',$departamentos, null, ['class' => 'form-control','placeholder'=> 'Seleccionar...'] ) }} 
	</div>

	<div class="form-group">
		{{ form::label('descripcion', 'Descripción *') }}
		{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) }}
	</div>

</div>





@push('js')
	<script type="text/javascript">


		id = $("#provincia_id option:selected").val();

		function cargar_departamentos(id) {

		    var provincia_id = id;//e.target.value;

		    $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

		      $('#departamento_id').empty();
		      $('#departamento_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');

		      $.each(data, function(fetch, departamento){
		        console.log(data);
		        $('#departamento_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
		      })
		    });
		}

		cargar_departamentos(id);


		
		$('#provincia_id').on('change', function(e){
		    /*console.log(e);
		    var provincia_id = e.target.value;

		    $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

		      $('#departamento_id').empty();
		      $('#departamento_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');

		      $.each(data, function(fetch, departamento){
		        console.log(data);
		        $('#departamento_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
		      })
		    });*/
		    id2 = $("#provincia_id option:selected").val();
		    cargar_departamentos(id2);
		});

	</script>
@endpush