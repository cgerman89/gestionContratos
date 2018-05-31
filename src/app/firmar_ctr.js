$(document).ready(function () {
   // console.log(' modulo firma cargado...');
    const departamento_ctr_firma_th=$('#departamento_ctr_firma_th');
    const contrato_file=$('#contrato_file');
    const btn_save_firma=$('#btn_save_firma');
    const form_file=$('#form_file');
    const btn_cerrar_md_firma=$('#btn_cerrar_md_firma');
    const departamento_ctr_firma_apb=$('#departamento_ctr_firma_apb');
    const departamento_ctr_firma_rdz=$('#departamento_ctr_firma_rdz');
    const id_ctr=$('#id_ctr');
    const contenedor_pdf_ctr=$('#contenedor_pdf_ctr');

    departamento_ctr_firma_th.select2({theme:"bootstrap"});
    departamento_ctr_firma_apb.select2({theme:"bootstrap"});
    departamento_ctr_firma_rdz.select2({theme:"bootstrap"});

    CargaComboDepartamentos(departamento_ctr_firma_th);
    CargaComboDepartamentos(departamento_ctr_firma_apb);
    CargaComboDepartamentos(departamento_ctr_firma_rdz);

    TablaContratoFirma();
    TablaContratosApb();
    TablaContratoRdz();

    btn_cerrar_md_firma.click(function (e) {
       e.preventDefault();
       form_file[0].reset();
    });

    departamento_ctr_firma_th.change(function () {
        TablaContratoFirma($(this).val());
    });
    
    departamento_ctr_firma_apb.change(function () {
        TablaContratosApb($(this).val());
    });
    
    departamento_ctr_firma_rdz.change(function () {
        TablaContratoRdz($(this).val());
    });
    btn_save_firma.click(function (e) {
       e.preventDefault();
        if(contrato_file.val() !== ''){
           SaveArchivo_ctr(function (res) {
                console.log(res);
                if(res.opcion === '1') {
                    $('#tabla_lista_contratos_firma').DataTable().ajax.reload();
                    toastr.info(res.mensaje);
                    form_file[0].reset();
                    $('#firma_md').modal('hide');
                }else if(res.opcion === '2') {
                   toastr.error(res.mensaje);
                }
           });
        }else {
            toastr.error('No ha Seleccionado El documento pdf');
            contrato_file.focus();
        }
    });

    contrato_file.change(function () {
        let file = $(this).val();
        let ext = file.substring(file.lastIndexOf("."));
        if(ext !== '.pdf'){
            toastr.error('TIPO DE ARCHIVO NO ES VALIDO');
            $(this).val('');
        }
    });
});
function ReloadTabla() {
    $('#departamento_ctr_firma_th').val('-2').trigger('change.select2');
    $('#departamento_ctr_firma_apb').val('-2').trigger('change.select2');
    $('#departamento_ctr_firma_rdz').val('-2').trigger('change.select2');
    $('#tabla_lista_contratos_firma').DataTable().ajax.reload();
    $('#tabla_lista_contratos_apb').DataTable().ajax.reload();
    $('#tabla_lista_contratos_rdz').DataTable().ajax.reload();
}

function ContratoPdf(id_ctr) {
    $('#contenedor_pdf_ctr').html("<iframe id='frame' height='650' width='100%' src='cFirma/LeerPdf/?id_ctr="+id_ctr+"'  frameborder='0'></iframe>");
    $('#pdf_contrato').modal('show');
}

function Mayus(campo) {
    $(campo).keyup(function () {
        $(this).val($(campo).val().toUpperCase())
    });

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
        $.post("cFirma/RechazarContrato",{'id_contrato':id_contrato,'observacion':observacion},function(data){
            if (data.opcion === '1') {
                ReloadTabla();
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
            $.post("cFirma/Deshacer",{'id_contrato':id_contrato},function(data){
                   ReloadTabla();
                   toastr.info(data.fnc_deshacer_proceso_contrato);
            },'json');
    },function (dismiss){});

}

function SaveArchivo_ctr(callback) {
    let archivo = $("#contrato_file").prop('files')[0];
    let data = new FormData();
    data.append('archivo', archivo);
    data.append('ced_asp', $('#cedula_asp').val());
    data.append('id_ctr', $('#id_ctr').val());
    $.ajax({
        url:"cFirma/SubirArchivo",
        type:'POST',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend:function () {
            swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
            swal.showLoading();
        },
        success:function(response){
            let res=JSON.parse(response);
            callback(res);
        },
        error:function(){
            console.log('Error en peticion ajax subir archivo pdf ');
        },
        complete:function () {
            swal.closeModal();
        }
    });
}

function AbrirModalFile(id_contrato,cedula_asp) {
    $('#form_file')[0].reset();
    if((id_contrato !== 0) && (cedula_asp !== '')) {
        $('#id_ctr').val(id_contrato);
        $('#cedula_asp').val(cedula_asp);
        $('#firma_md').modal('show');
    }
}

function Meses(fecha_final,fecha_inicial) {
    inicio=moment(fecha_inicial);
    finaliza=moment(fecha_final);
    if((inicio!==null&&inicio!=='undefined')&& (finaliza!==null&&finaliza!=='undefined')){
        return finaliza.diff(inicio,'month');
    }
}

function CargaComboDepartamentos(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function TablaContratoFirma(id_dpto){
    $('#tabla_lista_contratos_firma').DataTable({
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
            "url":"cFirma/ListarContratos",
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
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li> <li> <a href="#" onclick="AbrirModalFile('+data.id_contrato+',\''+data.cedula_aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-upload"></i> &nbsp; Subir </span> </a> </li> <li> <a href="#" onclick="RechazarContrato('+data.id_contrato+',\''+data.aspirante+'\')"> <span class="text-bold"> <i class="fas fa-times"></i> &nbsp; Rechazar </span> </a></li> </ul></div></span>';
                }
            }
        ]
    });
}

function TablaContratosApb(id_dpto){
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
            "url":"cFirma/ListarContratos",
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
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li> <li> <a href="#" onclick="ContratoPdf('+data.id_contrato+')"> <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Ver Documento </span> </a> </li>  </ul></div></span>';
                }
            }
        ]
    });
}

function TablaContratoRdz(id_dpto){
    $('#tabla_lista_contratos_rdz').DataTable({
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
            "url":"cFirma/ListarContratos_rzd",
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
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso"><span class="text-bold"><i class="fas fa-eye"></i> &nbsp; Ver Proceso </span></a></li>  </ul></div></span>';
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