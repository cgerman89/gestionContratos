$(document).ready(function () {
    console.log('modulo rector ctr cargado');
    const departamento_ctr_rec=$('#departamento_ctr_rec');
    const departamento_rec=$('#departamento_rec');
    const tabla_contratos_apb_rec=$('#tabla_contratos_apb_rec');

    CargaComboDepartamentos(departamento_ctr_rec);
    CargaComboDepartamentos(departamento_rec);

    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    departamento_ctr_rec.select2({theme:"bootstrap"});
    departamento_rec.select2({theme:"bootstrap"});
   
    TablaContratos();
    TablaContratosListos();

    $('#btn_apro_mas').click(function (e) {
        e.preventDefault();
        if($('#spNumSolApro').html() > 0){
            swal({
                title: 'Aprobar Contratos!',
                html: "<span>¿Aprobar Los ( <b>"+$('#spNumSolApro').html()+"</b> ) Registros Seleccionadas?</span>",
                type: 'warning',
                allowOutsideClick: false,
                allowEnterKey: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(function () {
                let cont=0;
                $('#tabla_contratos_apb_rec tbody tr').each(function(indiceFila) {
                    $(this).children('td').each(function(indiceColumna) {
                        if(indiceColumna == 7){
                            if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                                let idAspAp = $('.idAspApro:eq('+indiceFila+')').prop('id');
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
                    toastr.info(cont+' Contrato(s) aprobado(s) exitosamente.');
                    //LLenar tabla de acuerdo a lo que hay en el combo en la vista Solicitudes por aprobar
                    TablaContratos();
                    departamento_ctr_rec.val('-2').trigger('change.select2');
                    TablaContratosListos();

                },1000);
            },function (dismiss){});
        }else{
            toastr.error('No hay contratos seleccionada(s)');
        }
    });
    //Cuando den clic en algún checkbox, contabilice las solicitudes seleccionadas y las muestre
    tabla_contratos_apb_rec.on('click', 'input[type="checkbox"]', function() {
        let cont=0;
        $('#tabla_contratos_apb_rec tbody tr').each(function(indiceFila) {
            $(this).children('td').each(function(indiceColumna) {
                if(indiceColumna === 12){
                    if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                        cont++;
                    }
                }
            });
        });
        $('#spNumSolApro').html(cont);
    });

    //Cuando busquen, contabilice las solicitudes seleccionadas en pantalla y las muestre
    tabla_contratos_apb_rec.on('search.dt', function() {
        $('#tabla_contratos_apb_rec').on('draw.dt', function() {
            let cont=0;
            $('#tabla_contratos_apb_rec tbody tr').each(function(indiceFila) {
                $(this).children('td').each(function(indiceColumna) {
                    if(indiceColumna === 12){
                        if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                            cont++;
                        }
                    }
                });
            });
            $('#spNumSolApro').html(cont);
        });
    });

    departamento_ctr_rec.change(function () {
       TablaContratos($(this).val());
   });

    departamento_rec.change(function () {
       TablaContratosListos($(this).val());
   });
});
///funciones
function CargaComboDepartamentos(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
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
        $.post("cContratos_r/AprobarContrato",{'id_contrato':id_contrato},function(data){
            if (data.opcion === '1') {
                toastr.info(data.mensaje);
                $('#tabla_contratos_apb_rec').DataTable().ajax.reload();
            }else if (data.opcion === '2'){
                toastr.error(data.mensaje);
                $('#tabla_contratos_apb_rec').DataTable().ajax.reload();
            }
        },'json');
    },function (dismiss){});
}

function Meses(fecha_final,fecha_inicial) {
    let inicio=moment(fecha_inicial);
    let finaliza=moment(fecha_final);
    if((inicio!==null&&inicio!=='undefined')&& (finaliza!==null&&finaliza!=='undefined')){
        return finaliza.diff(inicio,'month');
    }
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

function TablaContratos(id_dpto){
    $('#tabla_contratos_apb_rec').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollCollapse": true,
        "scrollX": true,
        "responsive":true,
        "lengthMenu": [[-1], ["Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cContratos_r/ListaContratos",
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
            {"data":"codigo","width":"7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha_inicio","width":"9%"},
            {"data":"fecha_finaliza","width":"9%"},
            {"data":null},
            {"data":"partida"},
            {"data":"titulo","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data": null, 'searchable':false, "orderable": false},
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
            {
                "targets": [12],
                "render": function() {
                    return "<input class='checkboxstabla' id='checkbox1' name='checkbox1' type='checkbox' checked>";

                }
            },
            {   "targets": [13],
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <span class="text-bold"> <i  class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida </span></a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"> <i class="fa fa-gears"></i> Ver Proceso </span></a></li> <li> <a href="#" onclick="AprobarContrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span class="text-bold"> <i class="fa fa-check-square-o"></i> &nbsp; Aprobar Contrato </span> </a> </li>  </ul></div></span>';
                }
            }
        ]
    });
}

function TablaContratosListos(id_dpto){
    $('#tabla_contratos_listo').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollCollapse": true,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"cContratos_r/ListaContratosApb",
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
            {"data":"codigo","width":"7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha_inicio","width":"9%"},
            {"data":"fecha_finaliza","width":"9%"},
            {"data":null},
            {"data":"partida"},
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
            {   "targets": [12],
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <span class="text-bold"> <i  class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida </span></a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"> <i class="fa fa-gears"></i> Ver Proceso </span></a></li>  </ul></div></span>';
                }
            }
        ]
    });
}