$(document).ajaxStart(function () {
  // swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
   //swal.showLoading();
});
$(document).ajaxComplete(function () {
    //swal.closeModal();
});
$(document).ready(function () {
        $('#n_documento_per').prop('disabled',true);
        console.log('pagina info persona cargada');
        $('#fnacimiento').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
        CargaCombo_Infor_Per('#nacionalidad_per',8);
        CargaCombo_Infor_Per('#sexo_per',11);
        CargaCombo_Infor_Per('#e_civil_per',3);
        CargaCombo_Infor_Per('#t_sangre_per',22);
        CargaCombo_Infor_Per('#etnia_per',18);
        CargaCombo_Infor_Per('#tipo_discapacidad',23);
        Mayus('#apellido1');
        Mayus('#apellido2');
        Mayus('#nombres');
        toastr.options = {
            closeButton:true,
            positionClass:"toast-top-right",
            preventDuplicates:true
        };

        CargaDatosInfo(function (data){
            console.log(data.cedula);
                $('#n_documento_per').val(data.cedula);
                $('#nacionalidad_per').val(data.idtipo_nacionalidad).prop('selected','selected');
                $('#apellido1').val(data.apellido1);
                $('#apellido2').val(data.apellido2);
                $('#nombres').val(data.nombres);
                $('#fnacimiento').val(data.fecha_nacimiento);
                $('#sexo_per').val(data.idtipo_genero).prop('selected','selected');
                $('#e_civil_per').val(data.idtipo_estado_civil).prop('selected','selected');
                $('#t_sangre_per').val(data.idtipo_sangre).prop('selected','selected');
                $('#etnia_per').val(data.idtipo_etnia).prop('selected','selected');
                CargaPais(function (Datos) {
                    for(var num in Datos){
                        $('#pais_per').append('<option value='+Datos[num].idpais+'>'+Datos[num].nombre+'</option>');
                    }
                    $('#pais_per').val(data.idtipo_pais_origen).prop('selected','selected');
                });
                CargaProvincia(data.idtipo_pais_origen,function (datos) {
                    for (var n in datos){
                        $('#provincia_per').append('<option value='+datos[n].idprovincia+'>'+datos[n].nombre+'</option>');
                    }
                    $('#provincia_per').val(data.idtipo_provincia_origen).prop('selected','selected');
                });
                CargarCanton(data.idtipo_provincia_origen,function (canton) {
                    for (var n in canton){
                        $('#canton_per').append('<option value='+canton[n].idcanton+'>'+canton[n].nombre+'</option>');
                    }
                    $('#canton_per').val(data.idtipo_canton_origen).prop('selected','selected');
                });
                CargarParroquia(data.idtipo_canton_origen,function (parroquia) {
                    for (var n in parroquia){
                        $('#parroquia_per').append('<option value='+parroquia[n].idparroquia+'>'+parroquia[n].nombre+'</option>');
                    }
                    $('#parroquia_per').val(data.idtipo_parroquia_origen).prop('selected','selected');
                });
                ///info domicilio
                CargaPais(function (paises){
                    for(var n in paises){
                        $('#pais_domi').append('<option value='+paises[n].idpais+'>'+paises[n].nombre+'</option>');
                    }
                    $('#pais_domi').val(data.idtipo_pais_residencia).prop('selected','selected');
                });

                CargaProvincia(data.idtipo_pais_residencia,function (provincia) {
                    for(var n in provincia){
                        $('#provincia_domi').append('<option value='+provincia[n].idprovincia+'>'+provincia[n].nombre+'</option>');
                    }
                    $('#provincia_domi').val(data.idtipo_provincia_residencia).prop('selected','selected');
                });
                CargarCanton(data.idtipo_provincia_residencia,function (canton) {
                    for(var n in canton){
                        $('#canton_domi').append('<option value='+canton[n].idcanton+'>'+canton[n].nombre+'</option>');
                    }
                    $('#canton_domi').val(data.idtipo_canton_residencia).prop('selected','selected');
                });
                CargarParroquia(data.idtipo_canton_residencia,function (parroquia) {
                    for(var n in parroquia){
                        $('#parroquia_domi').append('<option value='+parroquia[n].idparroquia+'>'+parroquia[n].nombre+'</option>');
                    }
                    $('#parroquia_domi').val(data.idtipo_parroquia_residencia).prop('selected','selected');
                });
                $('#calle_prin').val(data.residencia_calle_1);
                $('#calle1_domi').val(data.residencia_calle_2);
                $('#calle2_domi').val(data.residencia_calle_3);
                $('#refrencia_domi').val(data.residencia_referencia);
                $('#num_casa').val(data.residencia_domicilio_numero);
                $('#telefono_domi').val(data.telefono_personal_domicilio);
                $('#celular_domi').val(data.telefono_personal_celular);
                $('#celular2_domi').val(data.telefono_personal_trabajo);
                $('#correo1_domi').val(data.correo_personal_institucional);
                $('#correo2_domi').val(data.correo_personal_alternativo);
                $('#tipo_discapacidad').val(data.idtipo_discapacidad).prop('selected','selected');
                $('#porcentaje').val(data.discapacidad_numero_porcentaje);
                $('#numero_carnet').val(data.discapacidad_numero_carne);
                $('#observacion_dis').val(data.discapacidad_observacion);

        });

       $('#pais_per').change(function () {
            $('#provincia_per  option').remove();
            $('#provincia_per').append('<option value="">Seleccione</option>');
            CargaProvincia($('#pais_per').val(),function (provincia) {
                 for (var n in provincia){
                     $('#provincia_per').append('<option value='+provincia[n].idprovincia+'>'+provincia[n].nombre+'</option>');
                 }
            });
        });

        $('#provincia_per').change(function () {
            $('#canton_per option').remove();
            $('#canton_per').append('<option value="">Seleccione</option>');
            CargarCanton($('#provincia_per').val(),function (canton){
                for(var n in canton){
                    $('#canton_per').append('<option value='+canton[n].idcanton+'>'+canton[n].nombre+'</option>');
                }
            });
        });

        $('#canton_per').change(function () {
            $('#parroquia_per option').remove();
            $('#parroquia_per').append('<option value="">Seleccione</option>');
            CargarParroquia($('#canton_per').val(),function (parroquia){
                for(var n in parroquia){
                    $('#parroquia_per').append('<option value='+parroquia[n].idparroquia+'>'+parroquia[n].nombre+'</option>');
                }
            });
        });

        $('#n_documento_per').focusout(function () {
            var td=$('#t_documento_per').val();
            if(td ===''){
                alertify.error('seleccione Tipo de Documento');
                $('#t_documento_per').focus();
            }else if(td ==='344'){
                if(CedVal($(this).val())=== false){
                    alertify.error('cedula incorrecta');
                    $(this).focus();
                }
            }
        });

        $('#btn_save_per').click(function (e) {
            e.preventDefault();
            if($('#form_info_per').smkValidate()){
                SaveInfoPer();
            }
        })
    });

//funciones
    function CargaDatosInfo(callback){
       $.ajax({
               url:'Perfil/RegisInf_Personal',
               type:'GET',
               dataType:'Json',
                beforeSend:function () {
                    swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                    swal.showLoading();
                },
               success:function (data){
                    callback(data);
               },
               complete:function () {
                   setTimeout(function () {
                       swal.closeModal();
                   },2500);
               }
       });
    }
    
    function CargaPais(callback) {
        $.post('Campos/Pais',function (datos, estado, xhr) {
            if (estado === 'success'){
                 callback(datos);
            }
        },'json');
    }

    function CargaProvincia(id_pais,callback) {
        $.post('Campos/Provincia',{id_pais:id_pais},function (datos, estado, xhr) {
            if (estado === 'success') {
               callback(datos);
            }
        },'json');
    }

    function CargarCanton(id_provincia,callback) {
        $.post('Campos/Canton',{id_provincia:id_provincia},function (datos, estado, xhr) {
            if (estado === 'success') {
                callback(datos);
            }
        },'json');
    }

    function CargarParroquia(id_canton,callback) {
        $.post('Campos/Parroquia',{id_canton:id_canton},function (datos, estado, xhr) {
            if (estado === 'success') {
                callback(datos);
            }
        },'json');
    }
    
    function CargaCombo_Infor_Per(combo,id) {
        $.post('Campos/Tipo',{'id':id},function (datos, estado, xhr) {
            if (estado === 'success') $.each(datos, function (index, value) {
                $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
            });
        },'json');
    }
    
    function Mayus(campo) {
        $(campo).keyup(function () {
            $(this).val($(campo).val().toUpperCase())
        });
    }
    
    function SaveInfoPer() {
        $.ajax({
            url:'Perfil/InforPersona',
            type:'POST',
            dataTypes:'json',
            data:$('#form_info_per').serialize(),
            beforeSend:function () {
                swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
                swal.showLoading();
            },
            success: function (data){
                var res=JSON.parse(data);
                toastr.success(res.info_personal);
            },
            complete:function () {
                swal.closeModal();
            },
            error: function (data) {
                console.log('error al guarda '+data)
            }
        });
    }
    



