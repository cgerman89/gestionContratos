function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });

}

function ContratoPdf(id_ctr) {
   window.location.href='cImprimir_ctr/Pdf/?id_ctr='+id_ctr+'';
}

function RechazarContrato(id_contrato,aspirante){
    swal({
        html: '¿Rechazar Contrato de: <br> <b>'+aspirante+'</b> ?',
        input: 'textarea',
        type: 'warning',
        showCloseButton: true,
        confirmButtonText: '<i style="color:white;" class="glyphicon glyphicon-remove"></i> Enviar',
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
                    reject('¡Por favor, escriba el motivo..')
                }
            })
        }
    }).then(function (observacion) {
        $.post("cImprimir_ctr/RechazarProceso",{'id_contrato':id_contrato,'observacion':observacion},function(data){
            if (data.opcion === '1') {
                $('#tabla_lista_contratos_imprimir').DataTable().ajax.reload();
                $('#tabla_lista_contratos_rzd').DataTable().ajax.reload();
                toastr.info(data.mensaje);
            }else if(data.opcion === '2'){
                toastr.error(data.mensaje);
            }
        },'json');
    },function (dismiss){});
}

function DeshacerProceso(id_contrato,aspirante) {
    swal({
        title: 'Deshacer Proceso!',
        html: "El PROCESO <span> DE: <b>"+aspirante+" </b></span> VOLVERA A PENDIENTE",
        type: 'warning',
        allowOutsideClick: false,
        allowEnterKey: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function () {
        $.post("cImprimir_ctr/Deshacer_Proceso",{'id_contrato':id_contrato},function(data){
            $('#tabla_lista_contratos_imprimir').DataTable().ajax.reload();
            $('#tabla_lista_contratos_apb').DataTable().ajax.reload();
            $('#tabla_lista_contratos_rzd').DataTable().ajax.reload();
            toastr.info(data.fnc_deshacer_proceso_contrato);
        },'json');
    },function (dismiss){});
}

function CargaComboDepartamentos(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function Aprobar_Ctontrato(id_contrato,aspirante) {
    swal({
        title: 'Imprimir Contrato!',
        html: "<span> De: "+aspirante+"</span>",
        type: 'info',
        allowOutsideClick: false,
        allowEnterKey: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function () {
        $.post("cImprimir_ctr/AprobarContrato",{'id_contrato':id_contrato},function(data){
            if (data.opcion === '1') {
                ContratoPdf(id_contrato);
                toastr.info(data.mensaje);
                $('#tabla_lista_contratos_imprimir').DataTable().ajax.reload();
                //$('#tabla_lista_contratos_apb').DataTable().ajax.reload();
            }else if (data.opcion === '2'){
                toastr.error(data.mensaje);
            }
        },'json');
    },function (dismiss){});
}

function TablaProcesoContrato(id_contrato) {
    $('#tabla_proceso_contrato').DataTable({
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
            "url":"cTalento_humano/ProcesosContrato",
            "data":{'id_contrato':id_contrato},
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
            {"data":"codigo"},
            {"data":"observacion"},
            {"data":"estado"}
        ],
        "columnDefs": [
            {
                "targets": [6],
                "data": "p_estdo",
                "render": function(data, type, full) {
                    if (data === 'P') {
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

function Tabla_Imprimir_Contratos(id_dpto) {
    $('#tabla_lista_contratos_imprimir').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 300,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cImprimir_ctr/ListarContratos",
            "data":{'id_dpto':id_dpto,'estado':'P'},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"codigo","width": "7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha_inicio","width":"7%"},
            {"data":"fecha_finaliza","width":"7%"},
            {"data":"meses","width": "5%"},
            {"data":"titulo","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data":"codigo_solicitud"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },
            {   "targets": [12],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li> <li> <a href="#" onclick="Aprobar_Ctontrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span  class="text-bold"><i class="fas fa-download"></i> &nbsp; Imprimir </span> </a> </li> <li> <a href="#" onclick="RechazarContrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span class="text-bold"> <i class="fas fa-times"></i> &nbsp; Rechazar </span> </a></li> </ul></div></span>';
                }
            }
        ]
    });
}

function Tabla_Contratos_apb(id_dpto){
    $('#tabla_lista_contratos_apb').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 300,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cImprimir_ctr/ListarContratos",
            "data":{'id_dpto':id_dpto,'estado':'A'},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"codigo","width": "7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha_inicio","width":"7%"},
            {"data":"fecha_finaliza","width":"7%"},
            {"data":"meses","width": "5%"},
            {"data":"titulo","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data":"codigo_solicitud"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },
            {   "targets": [12],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li>  <li> <a href="#"  onclick="DeshacerProceso('+data.id_contrato+',\''+data.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li>  </ul></div></span>';
                }
            }
        ]
    });
}

function Tabla_Contratos_rzd(id_dpto){
    $('#tabla_lista_contratos_rzd').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 300,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cImprimir_ctr/ListarContratos_rzd",
            "data":{'id_dpto':id_dpto,'estado':'R'},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"codigo","width": "7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha_inicio","width":"7%"},
            {"data":"fecha_finaliza","width":"7%"},
            {"data":"meses","width": "5%"},
            {"data":"titulo","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data":"codigo_solicitud"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },
            {   "targets": [12],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li>  <li> <a href="#"  onclick="DeshacerProceso('+data.id_contrato+',\''+data.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li>  </ul></div></span>';
                }
            }
        ]
    });
}


$(document).ready(function () {
     console.log('modulo imprime contrato cargado ..');

     const departamento_ctr_imprimir_th=$('#departamento_ctr_imprimir_th');
     const departamento_ctr_apb=$('#departamento_ctr_apb');
     const departamento_ctr_rzd=$('#departamento_ctr_rzd');

     CargaComboDepartamentos(departamento_ctr_imprimir_th);
     CargaComboDepartamentos(departamento_ctr_apb);
     CargaComboDepartamentos(departamento_ctr_rzd);

     departamento_ctr_imprimir_th.select2({theme:"bootstrap"});
     departamento_ctr_apb.select2({theme:"bootstrap"});
     departamento_ctr_rzd.select2({theme:"bootstrap"});

     Tabla_Imprimir_Contratos();
     Tabla_Contratos_apb();
     Tabla_Contratos_rzd();


     
     departamento_ctr_imprimir_th.change(function () {
         Tabla_Imprimir_Contratos($(this).val());
     });

     departamento_ctr_apb.change(function () {
            Tabla_Contratos_apb($(this).val());
     });
     departamento_ctr_rzd.change(function () {
            Tabla_Contratos_rzd($(this).val());
     });

});