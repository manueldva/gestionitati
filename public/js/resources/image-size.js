

$( "#image" ).change(function() {
  	var input = document.getElementById('image');
	var file = input.files[0];
	
	if(file.size > 2097152) {

		swal({
		  title: 'El archivo excede el tamaño maximo permitido',
		  text: 'El tamaño maximo es 2 MB (megabyte)',
		  type: 'error',
		  //confirmButtonColor: '#DD6B55',
		  confirmButtonText: 'OK!',
		  closeOnConfirm: false
		});

		$("#image").val(null);
	} 
});


 