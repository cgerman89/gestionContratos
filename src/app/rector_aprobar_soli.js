$(document).ready(function(){
    console.log('rector proceso cargado');

    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };

    $('#cbodepartamentoapro').select2({theme:"bootstrap"});
    $('#cbodepartamentoflu').select2({theme:"bootstrap"});
    $('#cbodetoSolicitudesRechazadas').select2({theme:"bootstrap"});


    tbl_aprobar_rector_depto();
    tbl_flujo_procesos_depto();
    tbl_flujo_procesos_solicitudes_rechazadas();

    //Llenar combo cbodepartamentoapro
    Combo_dpto_rector('#cbodepartamentoapro');
    Combo_dpto_rector('#cbodepartamentoflu');
    Combo_dpto_rector('#cbodetoSolicitudesRechazadas');


    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentoapro
    $('#cbodepartamentoapro').change(function () {
        tbl_aprobar_rector_depto($(this).val());
    });

    $('#cbodepartamentoflu').change(function () {
        tbl_flujo_procesos_depto($(this).val());
    });

    $('#cbodetoSolicitudesRechazadas').change(function () {
        tbl_flujo_procesos_solicitudes_rechazadas($(this).val());
    });

    //Aprobar masivamente
    $('#btn_apro_mas').click(function (e) {
        e.preventDefault();
        if($('#spNumSolApro').html() > 0){
            swal({
                title: 'Aprobar Solicitudes!',
                html: "<span>¿Aprobar Las ( <b>"+$('#spNumSolApro').html()+"</b> ) Solicitudes Seleccionadas?</span>",
                type: 'warning',
                allowOutsideClick: false,
                allowEnterKey: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(function () {
                let cont=0;
                $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
                    $(this).children('td').each(function(indiceColumna) {
                        if(indiceColumna === 7){
                            if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                                let idAspAp = $('.idAspApro:eq('+indiceFila+')').prop('id');
                                console.log("idaspap "+idAspAp);
                                Aprueba_rector_masivamente(idAspAp,function (datos) {
                                    if(datos.fnc_aprobar_rector === "OK"){
                                        cont++;
                                    }
                                });
                            }
                        }
                    });
                });
                setTimeout(function () {
                    toastr.info(cont+' Solicitud(es) aprobada(s) exitosamente.');
                    //LLenar tabla de acuerdo a lo que hay en el combo en la vista Solicitudes por aprobar
                    tbl_aprobar_rector_depto();
                    $('#cbodepartamentoflu').val('-2').trigger('change.select2');
                    tbl_flujo_procesos_depto();

                },1000);
            },function (dismiss){});
        }else{
            toastr.error('No hay solicitud(es) seleccionada(s)');
        }
    });

    //Cuando den clic en algún checkbox, contabilice las solicitudes seleccionadas y las muestre
    $('#tblLisAspPorApro').on('click', 'input[type="checkbox"]', function() {
        let cont=0;
        $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
            $(this).children('td').each(function(indiceColumna) {
                if(indiceColumna === 9){
                    if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                        cont++;
                    }
                }
            });
        });
        $('#spNumSolApro').html(cont);
    });

    //Cuando busquen, contabilice las solicitudes seleccionadas en pantalla y las muestre
    $('#tblLisAspPorApro').on('search.dt', function() {
        $('#tblLisAspPorApro').on('draw.dt', function() {
            let cont=0;
            $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
                $(this).children('td').each(function(indiceColumna) {
                    if(indiceColumna == 8){
                        if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                            cont++;
                        }
                    }
                });
            });
            $('#spNumSolApro').html(cont);
        });
    });

    $('#tblSolicitudesRechazadas').on("click","a.info_rechazada",function () {
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
//Aquí se llena la tabla Lista de Aspirantes por aprobar de algún departamento en específico con datatables
function tbl_aprobar_rector_depto(id_dpto) {
    $('#tblLisAspPorApro').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu": [[-1], ["Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cRectorado/ListaAprobarRectorDepto",
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
            {"data":"codigo","width": "8%"},
            {"data": null,"width": "13%"},
            {"data": 'departamento'},
            {"data": 'cordinador'},
            {"data": 'fecha_solicitud'},
            {"data": 't_contrato'},
            {"data": null},
            {"data": null, 'searchable':false, "orderable": false},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="Generar_hoja_vida('+row.id_personal+')"> <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Hoja De Vida </span> </a></li>' +
                            '    <li><a href="#" onClick="Aprueba_rector('+row.id_solicitud_contrato+',\''+row.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-check"></i> &nbsp; Aprobar </span> </a></li>' +
                            '    <li><a href="#" onClick="rechazar_rector('+row.id_solicitud_contrato+',\''+row.aspirante+'\')"> <span class="text-bold"> <i class="fas fa-times"></i> &nbsp; Rechazar </span> </a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render": function(data) {
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
                "targets": [7],
                "render": function(data) {
                    if (data.estado_apro_rec === 'P') {
                        return "<input class='checkboxstabla' id='checkbox1' name='checkbox1' type='checkbox' checked>";
                    }
                }
            },
        ],
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
        'ajax': {
            "url":"cRectorado/ListarFlujosProcesosDpto",
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
            {"data":"codigo","width": "8%"},
            {"data": null,"width": "13%"},
            {"data": 'departamento',"width": "13%"},
            {"data": 'cordinador',"width": "13%"},
            {"data": 'fecha_solicitud',"width": "9%"},
            {"data": 't_contrato',"width": "9%"},
            {"data":  null,"width": "13%"},
            {"data": 'observacion',"width": "18%"},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-list"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" onClick="Generar_hoja_vida('+row.id_personal+')"> <span class="text-bold"> <i class="far fa-file-pdf"></i>&nbsp; Hoja de Vida</span> </a></li>' +
                        '    <li><a href="#" data-toggle="modal" data-target="#md_proc_solic_y_contr" onClick="ProcesosSolicitudContrato(\''+row.id_solicitud_contrato+'\');"> <span class="text-bold"><i class="fas fa-eye"></i>&nbsp; Ver Proceso </span> </a></li>' +
                        '    </ul>' +
                        '</div>' +
                        '</span>';
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render": function(data) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data.aspirante+"</span><br>"+
                           "<span><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [6],
                "render": function(data, type, row) {
                    if (data.t_contrato === 'DOCENTE') {
                        return "<span>"+data.dedicacion+"</span>";
                    }
                    else if(data.t_contrato === 'ADMINISTRATIVO'){
                        return "<span>"+data.puesto+"</span>";
                    }
                }
            }
        ],
    });
}

//Aquí se llena la tabla Flujo de Procesos de las solicitudes rechazadas de todos los departamentos con datatables
function tbl_flujo_procesos_solicitudes_rechazadas(id_dpto) {
    $('#tblSolicitudesRechazadas').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cRectorado/SolicitudesRechazadas",
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
            {"data":"codigo","width": "8%"},
            {"data": null,"width": "13%"},
            {"data":'departamento'},
            {"data":'cordinador'},
            {"data":'fecha_solicitud'},
            {"data":'t_contrato'},
            {"data": null},
            {"data":'observacion'},
            {"data": null , 'searchable':false}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render": function(data) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data.aspirante+"</span><br>"+
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
            {   "targets": [8],
                "render": function(data) {
                    return "<span class='pull-left'><div class='dropdown'><button class='btn btn-default btn-xs dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><i class='fa fa-list'></i><span class='caret'></span></button><ul class='dropdown-menu pull-right' aria-labelledby='dropdownMenu1' style='background-color: #F5F5F5'><li><a href='#' onClick='Generar_hoja_vida("+data.id_personal+")'> <span class='text-bold'> <i class='far fa-file-pdf'></i>&nbsp; Hoja de Vida</span> </a></li><li><a href='#' class='info_rechazada'>  <span class='text-bold'> <i class='fa fa-info'></i> &nbsp; info </span> </a></li></ul></div></span>"
                }
            }
        ],
    });
}

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
            "url":"cRectorado/ProcesoContrato",
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
                        return '<span class="label label-danger">RECHAZADO</span>';
                    }else if (data === 'T'){
                        return '<span class="label label-success">TERMINADO</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-info">ACEPTADA</span>';
                    }
                }
            }
        ]
    });
};

//Con esta función aprobamos la solicitud (Cambiar el estado de la aprobación del rector)
Aprueba_rector = function(IdSolContrato,aspirante){
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
        $.post("cRectorado/AprobarSolicitud",{Id_sol_contrato:IdSolContrato},function(data){
                var res=JSON.parse(data);
                if (res.fnc_aprobar_rector === 'OK') {
                    toastr.info('Solicitud de: '+aspirante+' aprobada correctamente.');
                    $('#tblLisAspPorApro').DataTable().ajax.reload();
                    $('#tblLisAspFluProc').DataTable().ajax.reload();
                }
            });
    },function (dismiss){});
};

//Con esta función aprobamos masivamente las solicitudes (Cambiar el estado de la aprobación del rector)
function Aprueba_rector_masivamente(Id_sol_contrato,callback){
    $.post('cRectorado/AprobarSolicitud',{'Id_sol_contrato':Id_sol_contrato},function (datos,estado,xhr) {
        if(estado === 'success'){
           callback(datos);
        }
    },'json');
}

//Con esta función rechazamos la solicitud (Cambiar el estado de la aprobación del rector)
rechazar_rector = function(IdSolContrato, aspirante){
    swal({
      html: '¿Está seguro(a) de querer rechazar la solicitud de: <br> <b>'+aspirante+'</b> ?',
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
        $.post("cRectorado/RechazarSolicitud",{Id_sol_contrato:IdSolContrato,observa:observacion},function(data){
             let res=JSON.parse(data);
             if (res.fnc_rechazar_solicitud_rector === 'OK') {
                toastr.error('Solicitud de: '+aspirante+' rechazada correctamente.');
                $('#tblLisAspPorApro').DataTable().ajax.reload();
                $('#tblSolicitudesRechazadas').DataTable().ajax.reload();
             }
        });
    })
};

function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });

}

function Generar_hoja_vida(idpersonal) {
    let html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'>Hoja de Vida</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='cRectorado/Hoja_Vida/?id="+idpersonal+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}

function Combo_dpto_rector(combo) {
    $.post("cRectorado/GetListadoDepartamentos",function(data){
        let d = JSON.parse(data);
        $.each(d,function(i,item){
            $(combo).append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
        });
    });
}