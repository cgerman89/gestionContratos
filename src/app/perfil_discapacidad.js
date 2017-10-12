
$(document).ready(function() {
		console.log('pagina discapacidad cargada');
		$('#btn_save_discapacidad').click(function(e){
	         e.preventDefault();
	         if($('#form_discapacidad').smkValidate() === true) {
	         	 SaveDiscapacidad(function (res){
                     toastr.success(res.perfil_discapacidad);
                 });
	        }
		});
});

function SaveDiscapacidad(callback) {
	$.ajax({
		url: 'Perfil/Discapacidad',
		type: 'POST',
		dataType: 'json',
		data:$('#form_discapacidad').serialize(),
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
		success:function(response){
			callback(response);
		},
        complete:function () {
            swal.closeModal();
        },
		error:function() {
			console.log('Error al enviar la peticion Discapacidad ');
		}
	});
	
}