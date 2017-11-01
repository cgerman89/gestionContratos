
var num_asp=0;
var idpersonal=0;
$(document).ready(function () {
    console.log('registro aspirante cargada');
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    $('#fecha_sl_ctr').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    Mayus('#apellido1_asp');
    Mayus('#apellido2_asp');
    Mayus('#nombres_asp');
    CargaCombo_asp('#tipo_contrato_sl_ctr',66);
    CargaCombo_asp('#puesto_admin',72);
    CargaCombo_asp('#tipo_observacion_sl',73);
    CargaCombo_asp('#tipo_dedicacion_docente',69);
    CargaCombo_asp('#tipo_solicitud_tabla',66);
    Tabla_PreInscripcion();
    toastr.options = {
        closeButton:true,
        positionClass:"toast-top-right",
        preventDuplicates:true
    };

    $('#btn_cerrar_md_asp').click(function (e) {
        e.preventDefault();
        $('#form_aspirante').smkClear();
        BloqueDesbloqueo(0);
        $('#claves_asp').prop('hidden',true);
    });
    $('#btn_cerrar_md_solicitud_asp').click(function (e) {
        e.preventDefault();
        $('#form_solicitud_contrato_asp').smkClear();
        $('#form_tipo_docente').smkClear();
        $('#form_administrativo').smkClear();
        $('#form_administrativo').prop('hidden',true);
        $('#form_tipo_docente').prop('hidden',true);
    });

    $('#cedula_asp').focusout(function () {
         var cedula=$(this).val();
         if(cedula !==''){
             console.log('no esta vacia');
                 BuscarPersona(cedula,function (data){
                     if(data.num === 1) {
                         for (var n in data.datos) {
                             idpersonal=data.datos[n].idpersonal;
                             $('#apellido1_asp').val(data.datos[n].apellido1);
                             $('#apellido2_asp').val(data.datos[n].apellido2);
                             $('#nombres_asp').val(data.datos[n].nombres);
                             $('#correo_institucion_asp').val(data.datos[n].correo_personal_institucional);
                             BloqueDesbloqueo(1);
                         }
                     }else if(data.num === 0) {
                          idpersonal=0;
                          toastr.error('no existe el registro');
                          //BloqueDesbloqueo(0);
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

    $('#tabla_solicitud_docente').on("click","a.Ver_proceso",function () {
        var data = $('#tabla_solicitud_docente').DataTable().row( $(this).parents("tr") ).data();
        Tabla_Procesos(data.p_id_solicitud);
        $('#md_solicitud_proceso').modal('show');
    });

    $('#tabla_solicitud_admini').on("click","a.Ver_proceso",function () {
        var data = $('#tabla_solicitud_admini').DataTable().row( $(this).parents("tr") ).data();
        Tabla_Procesos(data.p_id_solicitud);
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
                        toastr.success(resp.p_mensaje);
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
                        toastr.success(resp.p_mensaje);
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
                        toastr.success(data.p_mensaje);
                    }else if(data.p_opcion=== '2'){
                        toastr.warning(data.p_mensaje);
                    }
                });
            }else if((idpersonal > 0) && ($('#correo_institucion_asp').val() === '')){
                toastr.warning('Nesecita  Un Usuario');
            }
        }

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
        case '2528':
            $('#form_administrativo').prop('hidden',true);
            $('#form_tipo_docente').prop('hidden',false);
            break;
        case '2529':
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

function Mostrar_tb_Solicitud(tipo_opcion) {
    switch(tipo_opcion){
        case '2528':
            $('#tb_admin').prop('hidden',true);
            Tabla_docente(tipo_opcion);
            break;
        case '2529':
            $('#tb_docente').prop('hidden',true);
            TablaAdministrativo(tipo_opcion);
            break;
        default:
            $('#tb_docente').prop('hidden',true);
            $('#tb_admin').prop('hidden',true);
            toastr.info('sii');
         break;
    }
}

function Tabla_docente(id_tipo){
     $('#tb_docente').prop('hidden',false);
      var tbl_docente=$('#tabla_solicitud_docente').DataTable({
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
            dataType:'json',
            data:{'tipo_solicitud':id_tipo},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":null,"width": "23%"},
            {"data":"p_tipo_solicitud"},
            {"data":"p_categoria"},
            {"data":"p_tipo_dedicacion"},
            {"data":"p_fecha"},
            {"data":"p_observacion"},
            {"data":"p_estdo"},
            {"defaultContent":"<span class='pull-left'><div class='dropdown'><button class='btn btn-default btn-xs dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><i class='fa fa-list'></i><span class='caret'></span></button><ul class='dropdown-menu pull-right' aria-labelledby='dropdownMenu1' style='background-color: #F5F5F5'><li><a href='#' class='Ver_proceso'><span class='text-bold'><i class='fa fa-cogs'></i>  Ver Proceso</span></a></li><li><a href='#' class='eliminar_pre_ins'><span class='text-bold'> <i class='fa fa-trash-o'></i>  Eliminar</span></a></li></ul></div></span>",'orderable': false, 'searchable': false,"width": "9%"}

        ],
        "columnDefs": [
            {
                "targets": [0],
                "render":function(data) {
                    return " <span class='text-center'> <i class='fa fa-user'></i> "+ data.p_persona+" <br><i class='fa fa-id-card'></i> "+ data.p_cedula+"</span>";
                }
            },
            {
                "targets": [6],
                "data": "p_estdo",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PROCESO</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-success">ACEPTADA</span>';
                    }
                }
            }
        ]
    });
    //ProcesoSolicitud("#tabla_solicitud_docente tbody", tbl_docente);
}

function TablaAdministrativo(id_tipo) {
    $('#tb_admin').prop('hidden',false);
   var tbl_admin=$('#tabla_solicitud_admini').DataTable({
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
           dataType:'json',
           data:{'tipo_solicitud':id_tipo},
           beforeSend:function () {
               swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
               swal.showLoading();
           },
           complete:function () {
               swal.closeModal();
           }
       },
       "columns":[
           {"data":null,"width": "20%"},
           {"data":"p_tipo_solicitud"},
           {"data":"p_categoria","width": "10%"},
           {"data":"p_puesto","width": "19%"},
           {"data":"p_fecha"},
           {"data":"p_observacion","width": "14%"},
           {"data":"p_estdo"},
           {"defaultContent":"<span class='pull-left'><div class='dropdown'><button class='btn btn-default btn-xs dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><i class='fa fa-list'></i><span class='caret'></span></button><ul class='dropdown-menu pull-right' aria-labelledby='dropdownMenu1' style='background-color: #F5F5F5'><li><a href='#' class='Ver_proceso'><span class='text-bold'><i class='fa fa-cogs'></i>  Ver Proceso</span></a></li><li><a href='#' class='eliminar_pre_ins'><span class='text-bold'> <i class='fa fa-trash-o'></i>  Eliminar</span></a></li></ul></div></span>",'orderable': false, 'searchable': false,"width": "9%"}

       ],
       "columnDefs": [
           {
               "targets": [0],
               "render":function(data) {
                   return " <span class='text-center'> <i class='fa fa-user'></i> "+ data.p_persona+" <br><i class='fa fa-id-card'></i> "+ data.p_cedula+"</span>";
               }
           },
           {   "targets": [6],
               "data": "p_estdo",
               "render": function(data, type, full) {
                   if(data === 'P'){
                       return '<span class="label label-warning">PROCESO</span>';
                   }else if(data === 'R') {
                       return '<span class="label label-danger">RECHAZADA</span>';
                   }else if (data === 'A'){
                       return '<span class="label label-success">ACEPTADA</span>';
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
            {"defaultContent":"<div class='pull-left'><div class='btn-group'><button type='button' class='btn btn-default'><i class='fa fa-list'></i></button><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><a href='#' class='Solicitud_asp'><span class='text-bold'> <i class='fa fa-paper-plane-o'></i>  Solicitud</span></a></li><li><a href='#' class='eliminar_pre_ins'> <span class='text-bold'> <i class='fa fa-trash-o'></i>  Eliminar </span> </a></li></ul></div></div>",'orderable': false, 'searchable': false}
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

function Tabla_Procesos(id_solicitud) {
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
            {"data":"p_proceso"},
            {"data":"p_fecha"},
            {"data":"p_hora"},
            {"data":"p_observacion"},
            {"data":"p_estado"}
        ],
        "columnDefs": [
            {
                "targets": [4],
                "data": "p_estdo",
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

function DelRegisTbl_inscripcion(tbody, table) {
    $(tbody).on("click","a.eliminar_pre_ins",function () {
        var data = table.row( $(this).parents("tr") ).data();
        alertify.confirm('Eliminar Registro',"Confirme para eliminar Usuario: <b>"+data.p_usuario+"</b>",
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
    $.post('Campos/Tipo',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaCombo_Hijo(combo,id){
    $(combo+'  option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('Campos/Tipo_hijo',{'id_hijo':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}