$(document).ready(function () {
   console.log('info personal listo');
   //crear variables jquery
    let fecha_nacimiento=$('#fnacimiento');
    let n_documento=$('#n_documento_per');
    let nacionalidad=$('#nacionalidad_per');
    let apellido1=$('#apellido1');
    let apellido2=$('#apellido2');
    let nombres=$('#nombres');
    let sexo_per=$('#sexo_per');
    let e_civil_per=$('#e_civil_per');
    let t_sangre_per=$('#t_sangre_per');
    let etnia_per=$('#etnia_per');
    let pais_per=$('#pais_per');
    let provincia_per=$('#provincia_per');
    let canton_per=$('#canton_per');
    let parroquia_per=$('#parroquia_per');
    let tipo_discapacidad=$('#tipo_discapacidad');
    let pais_domi=$('#pais_domi');
    let provincia_domi=$('#provincia_domi');
    let canton_domi=$('#canton_domi');
    let parroquia_domi=$('#parroquia_domi');
    let calle_prin=$('#calle_prin');
    let calle1_domi=$('#calle1_domi');
    let calle2_domi=$('#calle2_domi');
    let refrencia_domi=$('#refrencia_domi');
    let num_casa=$('#num_casa');
    let telefono_domi=$('#telefono_domi');
    let celular_domi=$('#celular_domi');
    let celular2_domi=$('#celular2_domi');
    let correo2_domi=$('#correo2_domi');
    let porcentaje=$('#porcentaje');
    let numero_carnet=$('#numero_carnet');
    let observacion_dis=$('#observacion_dis');
    let form_info_per=$('#form_info_per');
    let form_domicilio=$('#form_domicilio');
    let form_discapacidad=$('#form_discapacidad');
    let btn_save_per=$('#btn_save_per');
    let btn_save_domi=$('#btn_save_domi');
    let btn_save_discapacidad=$('#btn_save_discapacidad');
    //llamar funciones
    n_documento.prop('disabled',true);
    Mayus(apellido1);
    Mayus(apellido2);
    Mayus(nombres);
    Mayus(calle_prin);
    Mayus(calle1_domi);
    Mayus(calle2_domi);
    Mayus(refrencia_domi);
    fecha_nacimiento.datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    CargaCombo_Infor_Per(nacionalidad,8);
    CargaCombo_Infor_Per(sexo_per,11);
    CargaCombo_Infor_Per(e_civil_per,3);
    CargaCombo_Infor_Per(t_sangre_per,22);
    CargaCombo_Infor_Per(etnia_per,18);
    CargaCombo_Infor_Per(tipo_discapacidad,23);
    CargaPais(pais_per);
    CargaPais(pais_domi);

    CargaDatosInfo(function (data) {
        // console.log('documento perosna :'+data.cedula);
        n_documento.val(data.cedula);
        setTimeout(function () {
            if(data.idtipo_nacionalidad > 0)nacionalidad.val(data.idtipo_nacionalidad).prop('selected','selected');
        },300);
        apellido1.val(data.apellido1);
        apellido2.val(data.apellido2);
        nombres.val(data.nombres);
        fecha_nacimiento.val(data.fecha_nacimiento);
        setTimeout(function () {
            if(data.idtipo_genero > 0)sexo_per.val(data.idtipo_genero).prop('selected','selected');
        },300);
        setTimeout(function () {
            if(data.idtipo_estado_civil > 0)e_civil_per.val(data.idtipo_estado_civil).prop('selected','selected');
        },300);
        setTimeout(function () {
            if(data.idtipo_sangre > 0)t_sangre_per.val(data.idtipo_sangre).prop('selected','selected');
        },300);
        setInterval(function () {
            if(data.idtipo_sangre > 0)etnia_per.val(data.idtipo_etnia).prop('selected','selected');
        },300);
        if(data.idtipo_pais_origen > 0) setTimeout(function(){ pais_per.val(data.idtipo_pais_origen).prop('selected','selected'); }, 500);
        CargaProvincia(data.idtipo_pais_origen,provincia_per,function (datos) {
            $.each(datos, function (index, value) {
                provincia_per.append('<option value='+value.idprovincia+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_provincia_origen > 0)provincia_per.val(data.idtipo_provincia_origen).prop('selected','selected');
        });
        CargarCanton(data.idtipo_provincia_origen,canton_per,function (datos) {
            $.each(datos, function (index, value) {
                canton_per.append('<option value='+value.idcanton+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_canton_origen > 0)canton_per.val(data.idtipo_canton_origen).prop('selected','selected');
        });
        CargarParroquia(data.idtipo_canton_origen,parroquia_per,function (datos) {
            $.each(datos, function (index, value) {
                parroquia_per.append('<option value='+value.idparroquia+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_parroquia_origen > 0)parroquia_per.val(data.idtipo_parroquia_origen).prop('selected','selected');
        });
        if(data.idtipo_pais_residencia > 0) setTimeout(function(){ pais_domi.val(data.idtipo_pais_residencia).prop('selected','selected'); }, 500);
        CargaProvincia(data.idtipo_pais_residencia,provincia_domi,function (datos) {
            $.each(datos, function (index, value) {
                provincia_domi.append('<option value='+value.idprovincia+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_provincia_residencia > 0)provincia_domi.val(data.idtipo_provincia_residencia).prop('selected','selected');
        });
        CargarCanton(data.idtipo_provincia_residencia,canton_domi,function (datos) {
            $.each(datos, function (index, value) {
                canton_domi.append('<option value='+value.idcanton+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_canton_residencia > 0)canton_domi.val(data.idtipo_canton_residencia).prop('selected','selected');
        });
        CargarParroquia(data.idtipo_canton_residencia,parroquia_domi,function (datos) {
            $.each(datos, function (index, value) {
                parroquia_domi.append('<option value='+value.idparroquia+'>'+value.nombre +'</option>');
            });
            if(data.idtipo_parroquia_residencia > 0)parroquia_domi.val(data.idtipo_parroquia_residencia).prop('selected','selected');
        });
        calle_prin.val(data.residencia_calle_1);
        calle1_domi.val(data.residencia_calle_2);
        calle2_domi.val(data.residencia_calle_3);
        refrencia_domi.val(data.residencia_referencia);
        num_casa.val(data.residencia_domicilio_numero);
        telefono_domi.val(data.telefono_personal_domicilio);
        celular_domi.val(data.telefono_personal_celular);
        celular2_domi.val(data.telefono_personal_trabajo);
        correo2_domi.val(data.correo_personal_alternativo);
        if(data.idtipo_discapacidad > 0)tipo_discapacidad.val(data.idtipo_discapacidad).prop('selected','selected');
        porcentaje.val(data.discapacidad_numero_porcentaje);
        numero_carnet.val(data.discapacidad_numero_carne);
        observacion_dis.val(data.discapacidad_observacion);

    });
    
    //eventos jquery
    btn_save_per.click(function (e) {
        e.preventDefault();
        if(form_info_per.smkValidate()){
            SaveInfoPer(function (data) {
                toastr.info(data.info_personal,'INFORMACION PERSONAL');
            });
        }
    });

    btn_save_domi.click(function (e) {
        e.preventDefault();
        if(form_domicilio.smkValidate()){
            SaveDomicilio(function (data) {
                toastr.info(data.info_domicilio,'INFORMACION DOMICILIAR');
            });
        }
    });

    btn_save_discapacidad.click(function(e){
        e.preventDefault();
        if(form_discapacidad.smkValidate()) {
            SaveDiscapacidad(function (res) {
                toastr.info(res.perfil_discapacidad);
            });
        }
    });

    pais_per.change(function () {
        CargaProvincia(pais_per.val(),provincia_per,function (datos) {
            $.each(datos, function (index, value) {
                provincia_per.append('<option value='+value.idprovincia+'>'+value.nombre +'</option>');
            });
        });
    });

    provincia_per.change(function () {
        CargarCanton(provincia_per.val(),canton_per,function (datos) {
            $.each(datos, function (index, value) {
                canton_per.append('<option value='+value.idcanton+'>'+value.nombre +'</option>');
            });
        });
    });
    
    canton_per.change(function () {
       CargarParroquia(canton_per.val(),parroquia_per,function (datos) {
           $.each(datos, function (index, value) {
               parroquia_per.append('<option value='+value.idparroquia+'>'+value.nombre +'</option>');
           });
       });
    });
    
    pais_domi.change(function () {
        CargaProvincia(pais_domi.val(),provincia_domi,function (datos) {
            $.each(datos, function (index, value) {
                provincia_domi.append('<option value='+value.idprovincia+'>'+value.nombre +'</option>');
            });
        });
    });
    
    provincia_domi.change(function () {
        CargarCanton(provincia_domi.val(),canton_domi,function (datos) {
            $.each(datos, function (index, value) {
                canton_domi.append('<option value='+value.idcanton+'>'+value.nombre +'</option>');
            });
        });
    });
    
    canton_domi.change(function () {
        CargarParroquia(canton_domi.val(),parroquia_domi,function (datos) {
            $.each(datos, function (index, value) {
                parroquia_domi.append('<option value='+value.idparroquia+'>'+value.nombre +'</option>');
            });
        });
    });
});

//funciones
function CargaDatosInfo(callback){
    $.ajax({
        url:'Perfil/RegisInf_Personal',
        type:'GET',
        async: false,
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
            },5000);
        }
    });
}

function SaveInfoPer(callback) {
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
            callback(JSON.parse(data));
        },
        complete:function () {
            swal.closeModal();
        },
        error: function () {
            console.log('error al guardar en info personal');
        }
    });
}

function SaveDomicilio(callback) {
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
            callback(JSON.parse(data));
        },
        complete:function () {
            swal.closeModal();
        },
        error: function () {
            console.log('error en la peticion  ajax guardar domicilio');
        }
    });
}

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

function CargaPais(combo) {
    $.post('Campos/Pais',function (datos, estado) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idpais+'>'+value.nombre +'</option>');
        });
    },'json');
}

function CargaProvincia(id_pais,combo,callback){
    $(combo).find('option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Provincia',{id_pais:id_pais},function (datos, estado, xhr) {
        if (estado === 'success'){
            callback(datos);
        }
    },'json');
}

function CargarCanton(id_provincia,combo,callback) {
    $(combo).find('option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Canton',{id_provincia:id_provincia},function (datos, estado, xhr) {
        if (estado === 'success'){
            callback(datos);
        }
    },'json');
}

function CargarParroquia(id_canton,combo,callback) {
    $(combo).find('option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Parroquia',{id_canton:id_canton},function (datos, estado, xhr) {
        if (estado === 'success'){
            callback(datos);
        }
    },'json');
}






