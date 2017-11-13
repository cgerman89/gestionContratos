$(document).ready(function(){
    console.log('Se cargaron los aspirantes por aprobar en recursos humanos');

    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    $('#cbodepartamentoaproth').select2({theme:"bootstrap"});
    $('#cbodepartamentoflu').select2({theme:"bootstrap"});
    $('#cbodetoSolicitudesRechazadas').select2({theme:"bootstrap"});

    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };
    //Llenar combo cbodepartamentoaproth
    AllDpto_th('#cbodepartamentoaproth');
    AllDpto_th('#cbodepartamentoflu');
    AllDpto_th('#cbodetoSolicitudesRechazadas');

    tbl_aprobar_talento_humano_depto();
    tbl_flujo_procesos_depto();
    tbl_flujo_procesos_solicitudes_rechazadas_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentoaproth
    $('#cbodepartamentoaproth').change(function () {
        tbl_aprobar_talento_humano_depto($(this).val());
    });

    $('#cbodepartamentoflu').change(function () {
        tbl_flujo_procesos_depto($(this).val());
    });

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodetoSolicitudesRechazadas
    $('#cbodetoSolicitudesRechazadas').change(function () {
         tbl_flujo_procesos_solicitudes_rechazadas_depto($(this).val());
    });

    $('#tblSolicitudesRechazadas').on("click","button.info_rechazada",function () {
        let regis = $('#tblSolicitudesRechazadas').DataTable().row( $(this).parents("tr") ).data();
        $.post("cTalento_humano_as/InfoSolicitudRechazada",{'id_solicitud':regis.id_solicitud_contrato},function (data) {
             let res=JSON.parse(data);
             swal({
                 type: 'info',
                 html:"<div class='text-center'><span class='small'><p><i class='fa fa-cog' aria-hidden='true'></i> PROCESO : "+res.proceso+"</p> <p><i class='fa fa-user' aria-hidden='true'></i> USUARIO : "+res.usuario+"</p>  <p> <i class='fa fa-calendar' aria-hidden='true'></i> FECHA: "+res.fecha+"  <i class='fa fa-clock-o' aria-hidden='true'></i> HORA:"+res.hora+" </p><p><i class='fa fa-commenting' aria-hidden='true'></i> OBSERVACION: "+res.observacion+" </p></span></div>",
                 showCloseButton: true,
                 allowOutsideClick: false,
                 allowEnterKey: false
            });
        });
    });


});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes por aprobar en talento humano de algún departamento en específico con datatables
function tbl_aprobar_talento_humano_depto(id_dpto) {
    $('#tblLisAspPorAproTH').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cTalento_humano_as/ListaAprobarTalentoHumanoDepto",
            "type":"POST",
            "data":{'id_dpto':id_dpto},
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        'columns': [
            {"data":  null,"width": "13%"},
            {"data": 'departamento'},
            {"data": 'cordinador'},
            {"data": 'fecha_solicitud'},
            {"data": 't_contrato'},
            {"data": 'categoria'},
            {"data":  null},
            {"data": 'observacion'},
            {"data": 'estado_apro_rh'},
            {"data":  null,render:function(row){
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li><a href=""#" onClick="Generar_hoja_vida('+row.id_personal+')"> <i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li><li><a href="#" onclick="Aprobrar_th('+row.id_solicitud_contrato+',\''+row.aspirante+'\');"> <i style="color:green;" class="glyphicon glyphicon-ok"></i> Aprobar</a></li></ul></div></span>';
                    }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],                "render": function(data) {
                    return "<div class='idAspApro' id="+data.id_solicitud_contrato+"></div>" +
                           "<span><i class='fa fa-user'></i> &nbsp;"+data.aspirante+"</span><br>"+
                           "<span><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [6],
                "render": function(data) {
                    if (data.t_contrato === 'DOCENTE') {
                        return "<span>"+data.dedicacion+"</span>";
                    }
                    else if(data.t_contrato === 'ADMINISTRATIVO'){
                        return "<span>"+data.puesto+"</span>";
                    }
                }
            },
            {
                "targets": [8],
                "data": "estado_apro_rh",
                "render": function(data, type, row) {
                    if (data === 'P') {
                        return "<span class='label label-warning'>PENDIENTE</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Lista de Aspirantes Flujo de Procesos de algún departamento en específico con datatables
function tbl_flujo_procesos_depto(id_dpto) {
    $('#tblLisAspFluProc').DataTable({
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
            "url":"cTalento_humano_as/AprobadasTalentoHumano",
            "data":{'id_cbo_dpto_flu':id_dpto},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns": [
            {"data": null,"width": "13%"},
            {"data":'departamento'},
            {"data":'cordinador'},
            {"data":'fecha_solicitud'},
            {"data":'t_contrato'},
            {"data":'categoria'},
            {"data":null},
            {"data":'observacion'},
            {"data":'estado'},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [0],
                "render": function(data) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data.aspirante+"</span><br><span><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [6],
                "render":function(data) {
                    if(data.t_contrato === 'ADMINISTRATIVO'){
                        return " <span>"+ data.puesto+"</span>";
                    }else if(data.t_contrato === 'DOCENTE'){
                        return " <span>"+ data.dedicacion+"</span>";
                    }

                }
            },
            {   "targets": [8],
                "data": "estado",
                "render": function(data) {
                  if (data === 'A'){
                        return '<span class="label label-primary">APROBADA</span>';
                    }
                }
            },
            {   "targets": [9],
                "render": function(data) {
                return "<span class='pull-left'><div class='dropdown'><button class='btn btn-default btn-xs dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><i class='fa fa-list'></i><span class='caret'></span></button><ul class='dropdown-menu pull-right' aria-labelledby='dropdownMenu1' style='background-color: #F5F5F5'><li><a href='#' onClick='Generar_hoja_vida("+data.id_personal+")'><i style='color:black;' class='fa fa-file-pdf-o' aria-hidden='true'></i> Hoja de vida</a></li><li><a href='#' data-toggle='modal' data-target='#md_proc_solic_y_contr' onClick='ProcesosSolicitudContrato("+data.id_solicitud_contrato+")'><i class='fa fa-gears'></i> Ver Procesos</a></li></ul></div></span>"
                }
            }
        ]
    });
}

function tbl_flujo_procesos_solicitudes_rechazadas_depto(id_dpto) {
    $('#tblSolicitudesRechazadas').DataTable({
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
            "url":"cTalento_humano_as/RechazadasTalentoHumano",
            "data":{'id_dpto':id_dpto},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns": [
            {"data": null,"width": "13%"},
            {"data":'departamento'},
            {"data":'cordinador'},
            {"data":'fecha_solicitud'},
            {"data":'t_contrato'},
            {"data":'categoria'},
            {"data":null},
            {"data":'observacion'},
            {"data":'estado'},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [0],
                "render": function(data) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data.aspirante+"</span><br><span><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [6],
                "render":function(data) {
                    if(data.t_contrato === 'ADMINISTRATIVO'){
                        return " <span>"+ data.puesto+"</span>";
                    }else if(data.t_contrato === 'DOCENTE'){
                        return " <span>"+ data.dedicacion+"</span>";
                    }

                }
            },
            {   "targets": [8],
                "data": "estado",
                "render": function(data) {
                    if (data === 'R'){
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }
                }
            },
            {   "targets": [9],
                "render": function(data) {
                   return " <button type='button' class='info_rechazada  btn btn-default'><i class='fa fa-info'></i> info</button> ";

                }
            }
        ]
    });
}

//Con esta función aprobamos la solicitud (Cambiar el estado de la solicitud - talento humano)
function Aprobrar_th(idsolicitud,aspirante) {
    swal({
        title: 'Aprobar Solicitud!',
        html: "<span> De: "+aspirante+"</span>",
        type: 'warning',
        allowOutsideClick: false,
        allowEnterKey: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function () {
        $.post("",{Id_sol_contrato:idsolicitud},function(data){
            var res=JSON.parse(data);
            if (res.fnc_aprobar_rector === 'OK') {
                toastr.info('Solicitud de: '+aspirante+' aprobada correctamente.');
                $('#tblLisAspPorApro').DataTable().ajax.reload();
                $('#tblLisAspFluProc').DataTable().ajax.reload();
            }
        });
    },function (dismiss){});
}

//Con esta función rechazamos la solicitud (Cambiar el estado de la aprobación de talento humano)
rechazar_talento_humano = function(IdSolContrato, apellidop, apellidom, nombres){
    swal({
      html: '¿Está seguro(a) de querer rechazar la solicitud de: <b>'+apellidop+' '+apellidom+' '+nombres+'</b>?',
      input: 'textarea',
      type: 'warning',
      showCloseButton: true,
      confirmButtonText: '<i style="color:white;" class="glyphicon glyphicon-remove"></i> Rechazar',
      confirmButtonColor: '#d33',
      cancelButtonClass: 'btn btn-danger',
      allowOutsideClick: false, 
      allowEnterKey: false,
      inputAttributes: {
            'maxlength': 100
      },
      inputPlaceholder: 'Escriba el motivo del rechazo de la solicitud',  
      onOpen: function () {
            Mayus('.swal2-textarea');
      },
      inputValidator: function (value) {
        return new Promise(function (resolve, reject) {
          if (value) {
            resolve()
          } else {
            reject('¡Por favor, escriba el motivo del rechazo de la solicitud!')
          }
        })
      }
    }).then(function (observacion) {
        $.post("cTalento_humano_as/RechazarSolicitudTalentoHumano",
                {
                Id_sol_contrato:IdSolContrato,
                observa:observacion
                },
                function(data){
                    var res=JSON.parse(data);
                    if (res.fnc_rechazar_solicitud_talento_humano === 'OK') {
                        toastr.error('Solicitud de: '+apellidop+' '+apellidom+' '+nombres+' rechazada correctamente.');
                        $('#tblLisAspPorAproTH').DataTable().ajax.reload();
                        $('#tblLisAspFluProc').DataTable().ajax.reload();
                        $('#tblSolicitudesRechazadas').DataTable().ajax.reload();
                    }
                });
    })
};

ProcesosSolicitudContrato = function(IdSolicitudContrato){
    $('#tabla_proceso_solicitud').DataTable({
        "destroy":true,
        "paging": false,
        "searching": false,
        "ordering":  false,
        "info":false,
        "autoWidth":true,
        "orderClasses": true,
        "responsive":true,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cRectorado/ListarProcesosSolicitud",
            "dataType":'json',
            "data":{'id_solicitud':IdSolicitudContrato},
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"p_proceso"},
            {"data":"p_usuario"},
            {"data":"p_fecha"},
            {"data":"p_hora"},
            {"data":"p_observacion"},
            {"data":"p_estado"}
        ],
        "columnDefs": [
            {
                "targets": [5],
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

    $('#tabla_procesos_contrato').DataTable({
        "destroy":true,
        "paging": false,
        "searching": false,
        "ordering":  false,
        "info":false,
        "autoWidth":true,
        "orderClasses": true,
        "responsive":true,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cRectorado/ListarProcesosContrato",
            "dataType":'json',
            "data":{'id_solicitud':IdSolicitudContrato},
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"p_proceso","width": "18%"},
            {"data":"p_usuario"},
            {"data":"p_fecha"},
            {"data":"p_hora"},
            {"data":"p_observacion"},
            {"data":"p_estado"}
        ],
        "columnDefs": [
            {
                "targets": [5],
                "data": "p_estdo",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PENDIENTE</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADO</span>';
                    }else if (data === 'T'){
                        return '<span class="label label-success">TERMINADO</span>';
                    }
                }
            }
        ]
    });
};

function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });
}

function Generar_hoja_vida(idpersonal) {
    var html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'>Hoja de Vida</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='cTalento_humano_as/Hoja_Vida/?id="+idpersonal+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}

function AllDpto_th(combo) {
    $.post("cTalento_humano_as/GetListadoDepartamentos",function(data){
        var d = JSON.parse(data);
        $.each(d,function(i,item){
            $(combo).append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
        });
    });
}