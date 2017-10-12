$(document).ready(function () {
        console.log('pagina domicilio persona cargada');
        $('#correo1_domi').prop('disabled',true);
        Mayus_domi('#calle_prin');
        Mayus_domi('#calle1_domi');
        Mayus_domi('#calle2_domi');
        Mayus_domi('#refrencia_domi');

        $('#pais_domi').change(function () {
            $('#provincia_domi option').remove();
            $('#provincia_domi').append('<option value="">Seleccione</option>');
            CargaProvincia($('#pais_domi').val(),function (provincia) {
                for (var n in provincia){
                    $('#provincia_domi').append('<option value='+provincia[n].idprovincia+'>'+provincia[n].nombre+'</option>');
                }
            });
        });
        $('#provincia_domi').change(function () {
            $('#canton_domi option').remove();
            $('#canton_domi').append('<option value="">Seleccione</option>');
            CargarCanton($('#provincia_domi').val(),function (canton){
                for(var n in canton){
                    $('#canton_domi').append('<option value='+canton[n].idcanton+'>'+canton[n].nombre+'</option>');
                }
            });
        });
        $('#canton_domi').change(function () {
            $('#parroquia_domi option').remove();
            $('#parroquia_domi').append('<option value="">Seleccione</option>');
            CargarParroquia($('#canton_domi').val(),function (parroquia){
                for(var n in parroquia){
                    $('#parroquia_domi').append('<option value='+parroquia[n].idparroquia+'>'+parroquia[n].nombre+'</option>');
                }
            });
        });

        $('#btn_save_domi').click(function (e) {
            e.preventDefault();
            if($('#form_domicilio').smkValidate()){
                SaveDomicilio();
            }
        });
});

    function SaveDomicilio() {
        $.ajax({
            url:'Perfil/Domicilio',
            type:'POST',
            dataTypes:'json',
            data:$('#form_domicilio').serialize(),
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success: function (data){
                var res=JSON.parse(data);
                toastr.success(res.info_domicilio);
            },
            complete:function () {
                swal.closeModal();
            },
            error: function (data) {
                console.log('error en la peticion  ajax guardar domicilio  ');
            }
        });
    }
    function Mayus_domi(campo) {
        $(campo).keyup(function () {
            $(this).val($(campo).val().toUpperCase())
        });
    }
