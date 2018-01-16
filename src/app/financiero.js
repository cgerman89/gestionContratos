$(document).ready(function(){
   console.log(' financiero cargado.. ');
   const tabla_contratos_fn=$('#tabla_contratos_fn');
   const departamento_fn=$('#departamento_fn');
   const departamento_ctr_apb=$('#departamento_ctr_apb');
   const departamento_ctr_re=$('#departamento_ctr_re');

   //funciones
   departamento_fn.select2({theme:"bootstrap"});
   departamento_ctr_apb.select2({theme:"bootstrap"});
   departamento_ctr_re.select2({theme:"bootstrap"});
   CargaComboDepartamentos(departamento_fn);
   CargaComboDepartamentos(departamento_ctr_apb);
   CargaComboDepartamentos(departamento_ctr_re);
   
   TablaContratos();
   TablaContratosApb();
   TablaContratosRe();
   //eventos jquery
    departamento_fn.change(function () {
        TablaContratos($(this).val());
    });

    departamento_ctr_apb.change(function () {
        TablaContratosApb($(this).val());
    });

    departamento_ctr_re.change(function () {
        TablaContratosRe($(this).val());
    });
});
//funciones
function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });

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

function AprobarContrato(id_contrato,aspirante){
    swal({
        html: 'Ingrese Item Presupuestario para: <br> <b>'+aspirante+'</b> ',
        input: 'text',
        type: 'info',
        showCloseButton: true,
        confirmButtonText: '<i style="color:white;" class="fa fa-plus"></i> Agregar',
        confirmButtonColor: '#3085d6',
        cancelButtonClass: 'btn btn-danger',
        allowOutsideClick: false,
        allowEnterKey: false,
        inputAttributes: {
            'maxlength': 20
        },
        inputPlaceholder: 'ingrese item',
        onOpen: function () {
            Mayus('.swal2-input');
        },
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    resolve()
                } else {
                    reject('¡Por favor, Ingrese Item...')
                }
            })
        }
    }).then(function (item) {
        $.post("cFinanciero/AprobarContrato",{'id_contrato':id_contrato,'item':item},function(data){
            if (data.opcion === '1') {
                toastr.info(data.mensaje);
                $('#tabla_contratos_fn').DataTable().ajax.reload();
            }else if(data.opcion === '2'){
                toastr.error(data.mensaje);
                $('#tabla_contratos_fn').DataTable().ajax.reload();
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
        $.post("cFinanciero/RechazarContrato",{'id_contrato':id_contrato,'observacion':observacion},function(data){
            if (data.opcion === '1') {
                toastr.info(data.mensaje);
                $('#tabla_contratos_fn').DataTable().ajax.reload();
            }else if(data.opcion === '2'){
                toastr.error(data.mensaje);
                $('#tabla_contratos_fn').DataTable().ajax.reload();
            }
        },'json');
    },function (dismiss){});
}

function TablaContratos(id_dpto){
    $('#tabla_contratos_fn').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 200,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cFinanciero/ListaContratos",
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
            {"data":"codigo","width":"9%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"pais"},
            {"data":null,"width":"20%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"11%"},
            {"data":"fecha_inicio","width":"11%"},
            {"data":"fecha_finaliza","width":"11%"},
            {"data":"meses"},
            {"data":"p_510510"},
            {"data":"p_510203"},
            {"data":"p_510204"},
            {"data":"p_510601"},
            {"data":"p_510602"},
            {"data":"total_masa_salarial"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [3],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },        
            {   "targets": [16],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"> <li> <a href="#" onclick="AprobarContrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span class="text-bold"> <i class="fa fa-check-square-o"></i> &nbsp; Aprobar Contrato </span> </a> </li> <li> <a href="#" onclick="RechazarContrato('+data.id_contrato+',\''+data.aspirante+'\')"><span class="text-bold"><i class="fa fa-close"></i>&nbsp; Rechazar Contrato</span> </a> </li>  </ul></div></span>';
                }
            }
        ],
        "order": [[3,"asc"]],
    });
}

function TablaContratosApb(id_dpto){
    $('#tabla_contratos_apb').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 200,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cFinanciero/ListaContratos",
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
            {"data":"codigo","width":"9%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"pais"},
            {"data":null,"width":"20%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"11%"},
            {"data":"fecha_inicio","width":"11%"},
            {"data":"fecha_finaliza","width":"11%"},
            {"data":"meses"},
            {"data":"p_510510"},
            {"data":"p_510203"},
            {"data":"p_510204"},
            {"data":"p_510601"},
            {"data":"p_510602"},
            {"data":"total_masa_salarial"},
            {"data":"partida"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
        {
            "targets": [3],
            "render":function(data) {
                return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
            }
        },  
        {   "targets": [17],
            "render": function(data,row) {
                return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"> <li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"> <i class="fa fa-gears"></i> Ver Proceso </span></a></li>  </ul></div></span>';
            }
        }
    ]    
    });
}

function TablaContratosRe(id_dpto){
    $('#tabla_contratos_fn_re').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 200,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cFinanciero/ListaContratosRdz",
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
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"pais"},
            {"data":null,"width":"20%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"11%"},
            {"data":"fecha_inicio","width":"11%"},
            {"data":"fecha_finaliza","width":"11%"},
            {"data":"meses"},
            {"data":"p_510510"},
            {"data":"p_510203"},
            {"data":"p_510204"},
            {"data":"p_510601"},
            {"data":"p_510602"},
            {"data":"total_masa_salarial"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [3],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },      
            {   "targets": [16],
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"> <i class="fa fa-gears"></i> Ver Proceso </span></a></li>  </ul></div></span>';
                }
            }
        ]      
    });
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
            {"data":"observacion"},
            {"data":"estado"}
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
}

