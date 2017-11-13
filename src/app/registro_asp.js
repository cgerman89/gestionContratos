
var num_asp=0;
var idpersonal=0;
$(document).ready(function () {
    console.log('registro aspirante cargada');
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    $('#fecha_sl_ctr').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    Mayus('#apellido1_asp');
    Mayus('#apellido2_asp');
    Mayus('#nombres_asp');
    CargaCombo_asp('#tipo_contrato_sl_ctr',1);
    CargaCombo_asp('#puesto_admin',8);
    CargaCombo_asp('#tipo_observacion_sl',7);
    CargaCombo_asp('#tipo_dedicacion_docente',4);
    CargaCombo_asp('#tipo_solicitud_tabla',1);
    Tabla_PreInscripcion();
    Tabla_Solicitud();
    toastr.options = {
        closeButton:true,
        positionClass:"toast-top-right",
        preventDuplicates:true
    };

   $('#tab_solicitud').click(function (e) {
       e.preventDefault();
       Tabla_Solicitud();
   });

   $('#btn_cerrar_md_asp').click(function (e) {
        e.preventDefault();
        $('#form_aspirante').smkClear();
        BloqueDesbloqueo(0);
        $('#claves_asp').prop('hidden',true);
    });
    $('#btn_cerrar_md_solicitud_asp').click(function (e) {
        e.preventDefault();
        let form_docente=$('#form_tipo_docente');
        let form_admin=$('#form_administrativo');
        $('#form_solicitud_contrato_asp').smkClear();
        form_docente.smkClear();
        form_admin.smkClear();
        form_admin.prop('hidden',true);
        form_docente.prop('hidden',true);
    });

    $('#cedula_asp').focusout(function () {
         let cedula=$(this).val();
         if(cedula !==''){
             console.log('no esta vacia');
                 BuscarPersona(cedula,function (data){
                     if(data.num === 1){
                         idpersonal=data.info.idpersonal;
                         $('#apellido1_asp').val(data.info.apellido1);
                         $('#apellido2_asp').val(data.info.apellido2);
                         $('#nombres_asp').val(data.info.nombres);
                         $('#correo_institucion_asp').val(data.info.correo_personal_institucional);
                         BloqueDesbloqueo(1);
                     }else if(data.num === 0) {
                          idpersonal=0;
                          toastr.error('no existe el registro');
                          ClearCampos();
                     }
                 });

         }else {
             console.log('esta vacia');
         }
    });

    $('#tipo_solicitud_tabla').change(function () {
        Mostrar_tb_Solicitud($(this).val());
    });

    $('#tipo_contrato_sl_ctr').change(function () {
          Mostrar_Form($(this).val());
          CargaCombo_Hijo('#tipo_categoria_sl_ctr',$(this).val());
    });

    $('#tabla_solicitud').on("click","a.Ver_proceso",function () {
        var data = $('#tabla_solicitud').DataTable().row( $(this).parents("tr") ).data();
        Tabla_ProcesoSolicitud(data.id_solicitud_contrato);
        Tabla_ProcesoContrato(data.id_solicitud_contrato);
        $('#md_solicitud_proceso').modal('show');
    });

    $('#btn_enviar_docente_sl_ctr').click(function (e) {
       e.preventDefault();
       if( ($('#form_solicitud_contrato_asp').smkValidate() === true) && ($('#form_tipo_docente').smkValidate()=== true) ){
           var form_docente = new FormData();
                form_docente.append('id_personal',$('#txt_id_personal').val());
                form_docente.append('tipo_solicitud',$('#tipo_contrato_sl_ctr').val());
                form_docente.append('tipo_categoria',$('#tipo_categoria_sl_ctr').val());
                form_docente.append('fecha',$('#fecha_sl_ctr').val());
                form_docente.append('tipo_dedicacion',$('#tipo_dedicacion_docente').val());
                form_docente.append('id_observacion',$('#tipo_observacion_sl').val());
                form_docente.append('p_caso','DOCENTE');
                EnviarSolicitud(form_docente,function (resp) {
                    if(resp.p_opcion=== '1'){
                        toastr.info(resp.p_mensaje);
                    }else if(resp.p_opcion=== '2'){
                        toastr.warning(resp.p_mensaje);
                    }
                });
       }
    });

    $('#btn_enviar_admin_sl_ctr').click(function (e) {
        e.preventDefault();
        if( ($('#form_solicitud_contrato_asp').smkValidate() === true) && ($('#form_administrativo').smkValidate()=== true) ){
            var form_admin = new FormData();
                form_admin.append('id_personal',$('#txt_id_personal').val());
                form_admin.append('tipo_solicitud',$('#tipo_contrato_sl_ctr').val());
                form_admin.append('tipo_categoria',$('#tipo_categoria_sl_ctr').val());
                form_admin.append('fecha',$('#fecha_sl_ctr').val());
                form_admin.append('tipo_puesto',$('#puesto_admin').val());
                form_admin.append('id_observacion',$('#tipo_observacion_sl').val());
                form_admin.append('p_caso','ADMINISTRATIVO');
                EnviarSolicitud(form_admin,function (resp) {
                    if(resp.p_opcion=== '1'){
                        toastr.info(resp.p_mensaje);
                    }else if(resp.p_opcion=== '2'){
                        toastr.warning(resp.p_mensaje);
                    }
                });
        }
    });

    $('#btn_save_pre_insc').click(function (e) {
        e.preventDefault();
        if($('#form_aspirante').smkValidate()){
            if((idpersonal > 0) && ( $('#correo_institucion_asp').val()!=='') ){
                AgregarAspirante(function (data){
                    if(data.p_opcion=== '1'){
                        toastr.info(data.p_mensaje);
                    }else if(data.p_opcion=== '2'){
                        toastr.warning(data.p_mensaje);
                    }
                });
            }else if((idpersonal > 0) && ($('#correo_institucion_asp').val() === '')){
                toastr.warning('Nesecita  Un Usuario');
            }
        }

    });

    $('#tabla_inscricion').on("click","a.hoja_vida_asp",function () {
        let datos = $('#tabla_inscricion').DataTable().row( $(this).parents("tr") ).data();
        console.log('hoja de vida data :'+datos.p_idpersona);
        Generar_hoja_vida(datos.p_idpersona);
    });
});
//funciones

function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });
}

function EnviarSolicitud(form,callback) {
    $.ajax({
        url:'Aspirante/EnviarSolicitud',
        type:'POST',
        data:form,
        contentType: false,
        processData: false,
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success: function (data){
            var res=JSON.parse(data);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error: function (data) {
            console.error('error en la peticion crear aspirante ');
        }
    });
}

function AgregarAspirante(callback) {
    $.ajax({
        url:'Aspirante/AgregarAspirante',
        type:'POST',
        dataTypes:'json',
        data:{idpersonal:idpersonal},
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success: function (data){
            var res=JSON.parse(data);
            $('#tabla_inscricion').DataTable().ajax.reload();
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error: function (data) {
            console.error('error en la peticion agregrar aspirante ');
        }
    });
}

function ClearCampos() {
    $('#apellido1_asp').val('');
    $('#apellido2_asp').val('');
    $('#nombres_asp').val('');
    $('#correo_institucion_asp').val('');
    $('#claves_asp').prop('hidden',false);
}

function Mostrar_Form(tipo_solictud) {
    switch(tipo_solictud){
        case '1':
            $('#form_administrativo').prop('hidden',true);
            $('#form_tipo_docente').prop('hidden',false);
            break;
        case '2':
            $('#form_tipo_docente').prop('hidden',true);
            $('#form_administrativo').prop('hidden',false);
            break;
        default:
            $('#form_tipo_docente').prop('hidden',true);
            $('#form_administrativo').prop('hidden',true);
            break;
    }
}

function BuscarPersona(cedula,callback) {
    $.ajax({
        url:'Aspirante/Buscar',
        type:'POST',
        dataTypes:'json',
        data:{cedula:cedula},
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success:function (response) {
            var res=JSON.parse(response);
            callback(res);
        },
        complete:function () {
            swal.closeModal();
        },
        error: function () {
            console.log('error en peticion buscar persona');
        }
    });
}

function BloqueDesbloqueo(estado) {
    if(estado === 1){
       //$('#cedula_asp').prop('disabled',true);
       $('#apellido1_asp').prop('disabled',true);
       $('#apellido2_asp').prop('disabled',true);
       $('#nombres_asp').prop('disabled',true);
       $('#correo_institucion_asp').prop('disabled',true);
       $('#claves_asp').prop('hidden',true);
       $('#clave_asp').prop('required',false);
       $('#clave_verifica_asp').prop('required',false);

    }else if(estado === 0){
        //$('#cedula_asp').prop('disabled',false);
        $('#apellido1_asp').prop('disabled',false);
        $('#apellido2_asp').prop('disabled',false);
        $('#nombres_asp').prop('disabled',false);
        $('#correo_institucion_asp').prop('disabled',false);
        $('#claves_asp').prop('hidden',false);
        $('#clave_asp').prop('required',true);
        $('#clave_verifica_asp').prop('required',true);

    }
}

function Tabla_Solicitud(){
   let tbl_solicitud=$('#tabla_solicitud').DataTable({
          "destroy":true,
          "autoWidth":false,
          "scrollCollapse": true,
          "responsive":true,
          "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            method:"POST",
            url:"Aspirante/ListarSolicitud",
            dataType:'json'
        },
        "columns":[
            {"data":null,"width": "23%"},
            {"data":"t_contrato"},
            {"data":"categoria"},
            {"data":null},
            {"data":"fecha_solicitud","width": "7%"},
            {"data":"observacion"},
            {"data":"estado"},
            {"defaultContent":"<span class='pull-left'><div class='dropdown'><button class='btn btn-default btn-xs dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><i class='fa fa-list'></i><span class='caret'></span></button><ul class='dropdown-menu pull-right' aria-labelledby='dropdownMenu1' style='background-color: #F5F5F5'><li><a href='#' class='Ver_proceso'><span class='text-bold'><i class='fa fa-cogs'></i>&nbsp;Ver Proceso</span></a></li><li><a href='#' class='eliminar_pre_ins'><span class='text-bold'> <i class='fa fa-trash-o'></i>&nbsp;Eliminar</span></a></li></ul></div></span>",'orderable': false, 'searchable': false,"width": "9%"}

        ],
        "columnDefs": [
            {
                "targets": [0],
                "render":function(data) {
                    return " <span class='text-center'> <i class='fa fa-user'></i> "+ data.aspirante+" <br><i class='fa fa-id-card'></i> "+ data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [3],
                "render":function(data) {
                    if(data.t_contrato === 'ADMINISTRATIVO'){
                        return " <span>"+ data.puesto+"</span>";
                    }else if(data.t_contrato === 'DOCENTE'){
                        return " <span>"+ data.dedicacion+"</span>";
                    }

                }
            },
            {
                "targets": [6],
                "data": "estado",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PROCESO</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-primary">ACEPTADA</span>';
                    }
                }
            }
        ]
    });

}

function Tabla_PreInscripcion() {
    var tabla_inscripcion=$('#tabla_inscricion').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"Aspirante/ListarPreInscritos",
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":null,"width": "25%"},
            {"data":"p_usuario"},
            {"data":"p_departamento"},
            {"defaultContent":"<div class='pull-left'><div class='btn-group'><button type='button' class='btn btn-default'><i class='fa fa-list'></i></button><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><a href='#' class='hoja_vida_asp'><span class='text-bold'><i class='fa fa-file-pdf-o' aria-hidden='true'></i>&nbsp;Hoja De Vida</span></a></li><li><a href='#' class='Solicitud_asp'><span class='text-bold'> <i class='fa fa-paper-plane-o'></i>&nbsp;Solicitud</span></a></li><li><a href='#' class='eliminar_pre_ins'> <span class='text-bold'> <i class='fa fa-trash-o'></i>&nbsp;Eliminar </span> </a></li></ul></div></div>",'orderable': false, 'searchable': false}
        ],
        "columnDefs": [
            {
                "targets": [0],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i> "+ data.p_apellido1+" "+data.p_apellido2+" "+data.p_nombres+"<br><i class='fa fa-id-card'></i> "+ data.p_cedula+"</span>";
                }
            }
        ]

    });
    SolicitudAspirante("#tabla_inscricion tbody", tabla_inscripcion);
    DelRegisTbl_inscripcion("#tabla_inscricion tbody", tabla_inscripcion);
}

function Tabla_ProcesoSolicitud(id_solicitud) {
    var tbl_proceso=$('#tabla_proceso_solicitud').DataTable({
        "destroy":true,
        "paging": false,
        "searching": false,
        "ordering":  false,
        "autoWidth":true,
        "orderClasses": true,
        "responsive":true,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"Aspirante/ListarProceso",
            "dataType":'json',
            "data":{'id_solicitud':id_solicitud},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"proceso"},
            {"data":"usuario"},
            {"data":"fecha"},
            {"data":"hora"},
            {"data":"observacion"},
            {"data":"estado"}
        ],
        "columnDefs": [
            {
                "targets": [5],
                "data": "estado",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PENDIENTE</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-info">ACEPTADA</span>';
                    }
                }
            }
        ]
    });
}

function Tabla_ProcesoContrato(id_solicitud){
   let table_proceso_contrato=$('#tabla_procesos_contrato').DataTable({
       "destroy":true,
       "paging": false,
       "searching": false,
       "ordering":  false,
       "autoWidth":true,
       "orderClasses": true,
       "responsive":true,
       "language":{
           "url": 'public/locales/Spanish.json'
       },
   });
}

function DelRegisTbl_inscripcion(tbody, table) {
    $(tbody).on("click","a.eliminar_pre_ins",function () {
        var data = table.row( $(this).parents("tr") ).data();
        alertify.confirm('Eliminar Permiso',"Confirme para eliminar Permiso de Acceso al Usuario: <b>"+data.p_usuario+"</b>",
            function(){
                $.ajax({
                    url:'Aspirante/EliminarRol',
                    type:'Post',
                    dataTypes:'Json',
                    data:{'idpersonal':data.p_idpersona,'idrol':47},
                    beforeSend:function () {
                        swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                        swal.showLoading();
                    },
                    success:function(response){
                        var res=JSON.parse(response);
                        $('#tabla_inscricion').DataTable().ajax.reload();
                        toastr.info(res);
                    },
                    complete:function () {
                        swal.closeModal();
                    },
                    error:function() {
                        console.log('error en peticion borrar registro pre inscripcion');
                    }
                });
            },
            function(){

            });
    });

}

function SolicitudAspirante(tbody, table) {
    $(tbody).on("click","a.Solicitud_asp",function () {
        var data = table.row( $(this).parents("tr") ).data();
        console.log(data);
        $('#txt_id_personal').val(data.p_idpersona);
        $('#n_documento_sl_ctr').val(data.p_cedula);
        $('#nombres_sl_ctr').val(data.p_apellido1+" "+data.p_apellido2+" "+data.p_nombres);
        $('#usuario_sl_ctr').val(data.p_usuario);
        $('#departamento_sl_ctr').val(data.p_departamento);
        $('#modal_solicitud_contrato_asp').modal('show');
    });
}

function CargaCombo_asp(combo,id) {
    $.post('Campos/Tipo2',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaCombo_Hijo(combo,id){
    $(combo+'  option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Tipo_hijo2',{'id_hijo':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function Generar_hoja_vida(idpersonal) {
    var html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'>Hoja de Vida</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='Aspirante/Hoja_Vida/?id="+idpersonal+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}