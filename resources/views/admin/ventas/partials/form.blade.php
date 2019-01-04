<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('ventas.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">

	<div class="row">
		<div class="table-responsive">
			<table class="table table-striped table-hover" data-form="Form">
				<thead>
					<tr>
					<!--<th width="10px"> ID</th>-->
						<td> 
							{{ form::label('user_id', 'Vendedor *') }}
							{{ form::text('usuario_alta', 'mavila'	, ['class' => 'form-control', 'id' => 'usuario_alta', 'readonly' => 'readonly']) }}
						</td>
						<td> 
							{{ form::label('fecha', 'Fecha *') }}
							{{ form::date('fecha', Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
						</td>
						
					</tr>
					
				</thead>
			</table>
		</div>
	</div>
	<div class="form-group">
		{{ form::label('articulo_id', 'Buscar Articulo *') }}
		{{ form::select('articulo_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'articulo_id','placeholder' => 'Seleccionar...'] ) }}
	</div>

	<div class="form-group">
		{{ form::text('descripcion', null	, ['class' => 'form-control', 'id' => 'descripcion',  'style'=> 'display: none']) }}	
	</div>
	<div class="form-group">
		{{ form::text('precio', null	, ['class' => 'form-control', 'id' => 'precio',  'style'=> 'display: none']) }}	
	</div>


	<div class="row">
		<div class="table-responsive">
			<table class="table table-striped table-hover" data-form="Form">
				<thead>
					<tr>
					<!--<th width="10px"> ID</th>-->
						<td> 
							{{ form::label('codigo', 'Codigo *') }}
							{{ form::text('codigo', null, ['class' => 'form-control', 'id' => 'codigo', 'readonly' => 'readonly']) }}
						</td>
						<td> 
							{{ form::label('stock', 'Stock *') }}
							{{ form::number('stock', null , ['class' => 'form-control', 'id' => 'stock', 'min' => '0' , 'readonly' => 'readonly']) }}
						</td>
						<td> 
							{{ form::label('cantidad', 'Cantidad *') }}
							{{ form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad', 'min' => '0']) }}
						</td>
						<td> 
							<br>
							<a type="button" class="btn btn-sm btn-success" id="agregar">
								<span class="glyphicon glyphicon-plus">
								</span>
							</a>
						</td>
						
					</tr>
					
				</thead>
			</table>
		</div>
	</div>

		

</div>

<div class="col-md-8">
	
	
	<div class="panel-body">
		<div class="row">
				<div class="table-responsive">
					<table   id="table_ventas" class="table table-striped table-hover" data-form="Form">
						<thead>
							<tr>
							<!--<th width="10px"> ID</th>-->
								<th> Codigo</th>
								<th> Descripción</th>
								<th> Cantidad</th>
								<th> Precio Unitario</th>
								<th> Sub-total</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>




@push('js')		

	<script type="text/javascript">

		$(document).ready(function(){
            $('#articulo_id').select2({
				language: {

					noResults: function() {

					return "No hay resultado";        
					},
					searching: function() {

					return "Buscando..";
					},
				},
				
                ajax : {
                    url : '../api/articulos',
                    dataType : 'json',
                    delay : 20,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
				minimumInputLength: 1,
                templateResult : function (repo){
                    if(repo.loading) return repo.descripcion;
                    var markup =  repo.descripcion;
                    return markup;
                },
                templateSelection : function(repo)
                {
					$("#codigo").val(repo.codigo);
					$("#stock").val(repo.stock);
					$("#descripcion").val(repo.descripcion);
					$("#precio").val(repo.preciounitario);
					if($("#stock").val() !== '') $("#cantidad").val(1);
					
					return repo.descripcion;
					
                },
                escapeMarkup : function(markup){ 
					
					return markup; 
				}
            });
        });

	
		$( "#agregar" ).click(function() {

			/*para validar que no supere el stock ya ingresado en la grilla*/
			var stocktemp = 0;
			$('#table_ventas tr').each(function(index, element) {
			    codigotemp = $(element).find("td").eq(0).text();
			    cantidadtemp = $(element).find("td").eq(2).text();

			    if(codigotemp == $("#codigo").val())
			    {
			    	stocktemp = stocktemp + parseInt(cantidadtemp);
			    }
			   
			    //alert(codigotemp);

			});

			stocktemp = parseInt($("#stock").val()) - stocktemp;
			/**/
			
			/*validaciones*/ 
			if($("#stock").val() == ''  || $("#cantidad").val() == '') {
				swal({
					title: 'No se puede vender este producto',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});
				return false;
			} else if(parseInt($("#cantidad").val()) < 1) {
				swal({
					title: 'No se puede vender este producto',
					text: 'Debe ingresar una cantidad mayor o igual a 1',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});

				return false;

			} else if(stocktemp < parseInt($("#cantidad").val())) {
				swal({
					title: 'No se puede vender este producto',
					text: 'El stock actual es menor a la cantidad ingresada',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});

				return false;
			}

			/**/
			
			//variables para guardar en la grilla
			var codigo = $("#codigo").val();
			var descripcion = $("#descripcion").val();
			var precio_unitario = parseFloat($("#precio").val()).toFixed(2);
			var cantidad = parseInt($("#cantidad").val());
			var precio_subtotal = parseFloat(precio_unitario * cantidad).toFixed(2); 
			
			//cargo la grilla
			$('#table_ventas tbody').prepend(
				'<tr>' + 
				'<td>' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				'<td>$' + precio_unitario + '</td>' +
				'<td>$' + precio_subtotal + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='delete_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');
			
			//$("#codigo").val('');
			//$("#descripcion").val('');
			//$("#precio").val('');
			//prueba para descontar stock
			//$("#stock").val(parseInt(parseInt($("#stock").val()) - $("#cantidad").val()));
			$("#cantidad").val(1);

			toastr.success('Producto agregado a la lista de compras');
			

		});


		function delete_row(row) {
			/*var subtotal = row.closest('tr').find("td").eq(6).html();
			var cantidad = row.closest('tr').find("td").eq(2).html();
			var cantidadActualArticulo = $("#txtCantidadArticulos").val();

			cantidadActualArticulo = parseInt(cantidadActualArticulo) - parseInt(cantidad);
			$("#txtCantidadArticulos").val(cantidadActualArticulo);

			subtotal = parseFloat(-subtotal.slice(1));
			actualizar_total_proforma(subtotal);*/
		  	row.closest('tr').remove();
		  	toastr.info('Producto eliminado de la lista');
		}	

	</script>

@endpush

