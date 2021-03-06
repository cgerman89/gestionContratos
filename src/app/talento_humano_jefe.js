$(document).ready(function () {
   console.log('th jefe cargado...');
   const departamento_ctr_th=$('#departamento_ctr_th');
   const tabla_contratos_th_jefe=$('#tabla_contratos_th_jefe');
   const departamento_ctr_apb=$('#departamento_ctr_apb');
   const departamento_ctr_re=$('#departamento_ctr_re');
   const departamento_ctr_t=$('#departamento_ctr_t');
   const departamento_ctr_anu = $('#departamento_ctr_anu');

   departamento_ctr_th.select2({theme:"bootstrap"});
   departamento_ctr_apb.select2({theme:"bootstrap"});
   departamento_ctr_re.select2({theme:"bootstrap"});
   departamento_ctr_t.select2({theme:"bootstrap"});
   departamento_ctr_anu.select2({theme:"bootstrap"});
   CargaComboDepartamentos(departamento_ctr_th);
   CargaComboDepartamentos(departamento_ctr_apb);
   CargaComboDepartamentos(departamento_ctr_re);
   CargaComboDepartamentos(departamento_ctr_t);
   CargaComboDepartamentos( departamento_ctr_anu);
   TablaContratos();
   TablaContratosApb(-1);
   TablasContratosRe(-1);

   //eventos jquery
    departamento_ctr_th.change(function () {
        TablaContratos($(this).val());
    });

    departamento_ctr_anu.change(function () {
        TablasContratosAnu($(this).val());
    });

    departamento_ctr_t.change(function () {
        TablaContratosTrd($(this).val());
    });

    departamento_ctr_apb.change(function () {
        TablaContratosApb($(this).val());
    });

    departamento_ctr_re.change(function () {
        TablasContratosRe($(this).val());
    });

    function TablaContratos(id_dpto){
        $('#tabla_contratos_th_jefe').DataTable({
            "destroy":true,
            "autoWidth":true,
            "scrollY": 300,
            "scrollCollapse":false,
            "scrollX": true,
            "responsive":true,
            "language":{
                "url": 'public/locales/Spanish.json'
            },
            "ajax":{
                "method":"POST",
                "url":"Contrato/ListaContratos",
                "data":{'id_dpto':id_dpto},
                beforeSend:function () {
                    swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                    swal.showLoading();
                },
                complete:function () {
                    swal.closeModal();
                }
            },
            "columns":[
                {"data":"codigo","width":"9%"},
                {"data":null,"width":"20%"},
                {"data":"modalidad_laboral","width":"10%"},
                {"data":"tipo","width":"9%"},
                {"data":"deominacion","width":"20%"},
                {"data":"remuneracion","width":"5%"},
                {"data":"fecha_inicio","width":"7%"},
                {"data":"fecha_finaliza","width":"7%"},
                {"data":null},
                {"data":"titulo","width":"20%"},
                {"data":"departamento","width":"9%"},
                {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
            ],
            "columnDefs": [
                {
                    "targets": [1],
                    "render":function(data) {
                        return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                    }
                },
                {
                    "targets": [8],
                    "render":function(data) {
                        return " <span> "+Meses(data.fecha_finaliza,data.fecha_inicio)+" </span>";
                    }
                },
                {   "targets": [11],
                    "render": function(data) {
                        return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Hoja De Vida </span> </a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li> <li> <a href="#" onclick="AprobarContrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-check"></i> &nbsp; Aprobar </span> </a> </li> <li> <a href="#" onclick="RechazarContrato('+data.id_contrato+',\''+data.aspirante+'\')"><span class="text-bold"> <i class="fas fa-times"></i> &nbsp; Rechazar </span> </a> </li> </ul></div></span>';
                    }
                }
            ]
        });
    }

    function TablaContratosApb(id_dpto) {
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
                "url":"Contrato/ListarContratos_proceso_Jefe",
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
                {"data":"codigo","width": "9%"},
                {"data":null,"width":"20%"},
                {"data":"modalidad_laboral","width":"10%"},
                {"data":"tipo","width":"9%"},
                {"data":"deominacion","width":"20%"},
                {"data":"remuneracion","width":"5%"},
                {"data":"fecha_inicio","width":"7%"},
                {"data":"fecha_finaliza","width":"7%"},
                {"data":null,"width": "5%"},
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
                {
                    "targets": [8],
                    "render":function(data) {
                        return " <span> "+Meses(data.fecha_finaliza,data.fecha_inicio)+" </span>";
                    }
                },
                {   "targets": [12],
                    "render": function(data,row) {
                        return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')">  <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Hoja De Vida </span> </a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"><i class="fas fa-eye"></i>&nbsp; Ver Proceso </span></a></li>   <li> <a href="#"  onclick="DeshacerProceso('+data.id_contrato+',\''+data.aspirante+'\',\''+data.estado_financiero+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li> </ul></div></span>';
                    }
                }
            ]
        });
    }
    
    function TablasContratosRe(id_dpto) {
        $('#tabla_lista_contratos_r').DataTable({
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
                "url":"Contrato/ListarContratos_proceso_Jefe",
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
                {"data":"codigo","width": "9%"},
                {"data":null,"width":"20%"},
                {"data":"modalidad_laboral","width":"10%"},
                {"data":"tipo","width":"9%"},
                {"data":"deominacion","width":"20%"},
                {"data":"remuneracion","width":"5%"},
                {"data":"fecha_inicio","width":"7%"},
                {"data":"fecha_finaliza","width":"7%"},
                {"data":null,"width": "5%"},
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
                {
                    "targets": [8],
                    "render":function(data) {
                        return " <span> "+Meses(data.fecha_finaliza,data.fecha_inicio)+" </span>";
                    }
                },
                {   "targets": [12],
                    "render": function(data,row) {
                        return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Hoja De Vida </span> </a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li>  <li> <a href="#"  onclick="DeshacerProceso('+data.id_contrato+',\''+data.aspirante+'\',\''+data.estado_financiero+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li> </ul></div></span>';
                    }
                }
            ]
        });
    }

});
//funciones
function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });

}

function DeshacerProceso(id_contrato,aspirante,estado_financiero) {
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
            $.post("Contrato/Deshacer",{'id_contrato':id_contrato},function(data){
                    $('#tabla_contratos_th_jefe').DataTable().ajax.reload();
                    $('#tabla_lista_contratos_apb').DataTable().ajax.reload();
                    $('#tabla_lista_contratos_r').DataTable().ajax.reload();
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

function Meses(fecha_final,fecha_inicial) {
    let inicio=moment(fecha_inicial);
    let finaliza=moment(fecha_final);
    if((inicio!==null&&inicio!=='undefined')&& (finaliza!==null&&finaliza!=='undefined')){
        return finaliza.diff(inicio,'month');
    }
}

function Generar_hoja_vida(id_persona) {
    let html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'>Hoja de Vida</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='cTalento_humano/Hoja_Vida/?id="+id_persona+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}

function AprobarContrato(id_contrato,aspirante){
    swal({
        title: 'Aprobar Contrato!',
        html: "<span> De: "+aspirante+"</span>",
        type: 'warning',
        allowOutsideClick: false,
        allowEnterKey: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function () {
        $.post("Contrato/AprobarContrato",{'id_contrato':id_contrato},function(data){
            if (data.opcion === '1') {
                toastr.info(data.mensaje);
                $('#tabla_contratos_th_jefe').DataTable().ajax.reload();
                $('#tabla_lista_contratos_apb').DataTable().ajax.reload();
            }else if (data.opcion === '2'){
                toastr.error(data.mensaje);
            }
        },'json');
    },function (dismiss){});
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
        $.post("Contrato/RechazarContrato",{'id_contrato':id_contrato,'observacion':observacion},function(data){
            if (data.opcion === '1') {
                toastr.info(data.mensaje);
                $('#tabla_contratos_th_jefe').DataTable().ajax.reload();
            }else if(data.opcion === '2'){
                toastr.error(data.mensaje);
                $('#tabla_contratos_th_jefe').DataTable().ajax.reload();
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




