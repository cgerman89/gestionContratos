$(document).ready(function () {
   console.log('modulo talento humano cargado..');
   $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips
   toastr.options = {closeButton:true,positionClass: "toast-top-right",preventDuplicates: true};
   const cbodepartamentoaproth=$('#cbodepartamentoaproth');
   const cbodepartamentoflu=$('#cbodepartamentoflu');
   const cbodetoSolicitudesRechazadas=$('#cbodetoSolicitudesRechazadas');
   const tblLisAspPorAproTH=$('#tblLisAspPorAproTH');
   const tblLisAspFluProc=$('#tblLisAspFluProc');
   const tblSolicitudesRechazadas=$('#tblSolicitudesRechazadas');
   //cargar librerias
    cbodepartamentoaproth.select2({theme:"bootstrap"});
    cbodepartamentoflu.select2({theme:"bootstrap"});
    cbodetoSolicitudesRechazadas.select2({theme:"bootstrap"});
    //llamar funciones
    AllDpto_th(cbodepartamentoaproth);
    AllDpto_th(cbodepartamentoflu);
    AllDpto_th(cbodetoSolicitudesRechazadas);
    CargarListaSolicitud_th();
    CargarAprobadas_th();
    CargaRechazadas_th();

    //eventos
    cbodepartamentoaproth.change(function () {
        CargarListaSolicitud_th($(this).val());
    });

    cbodepartamentoflu.change(function () {
        CargarAprobadas_th($(this).val());
    });

    cbodetoSolicitudesRechazadas.change(function () {
        CargaRechazadas_th($(this).val());
    });

    tblSolicitudesRechazadas.on("click","a.info_rechazada",function () {
        let regis = tblSolicitudesRechazadas.DataTable().row( $(this).parents("tr") ).data();
        $.post("cTalento_humano_as/InfoSolicitudRechazada",{'id_solicitud':regis.id_solicitud_contrato},function (data) {
            swal({
                type: 'info',
                html:"<div class='text-center'><span class='small'><p><i class='fa fa-cog' aria-hidden='true'></i> PROCESO : "+data.proceso+"</p> <p><i class='fa fa-user' aria-hidden='true'></i> USUARIO : "+data.usuario+"</p>  <p> <i class='fa fa-calendar' aria-hidden='true'></i> FECHA: "+data.fecha+"  <i class='fa fa-clock-o' aria-hidden='true'></i> HORA:"+data.hora+" </p><p><i class='fa fa-commenting' aria-hidden='true'></i> OBSERVACION: "+data.observacion+" </p></span></div>",
                showCloseButton: true,
                allowOutsideClick: false,
                allowEnterKey: false
            });
        },'json');
    });
});

//funciones
function AllDpto_th(combo) {
    $.post("cTalento_humano_as/GetListadoDepartamentos",function(datos,estado){
          if (estado === 'success'){
              $.each(datos, function (index, value) {
               $(combo).append('<option value="'+value.iddepartamento+'">'+value.nombre+'</option>')
              });
          }
    },'json');
}

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
    html +="<iframe id='frame' height='650' width='100%' src='cTalento_humano_as/Hoja_Vida/?id="+idpersonal+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}

function CargarListaSolicitud_th(id_dpto) {
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
            {"data":"codigo"},
            {"data":  null,"width": "13%"},
            {"data": 'departamento'},
            {"data": 'cordinador'},
            {"data": 'fecha_solicitud'},
            {"data": 't_contrato'},
            {"data":  null},
            {"data": 'observacion'},
            {"data":  null,render:function(row){
                return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li><a href="#" onClick="Generar_hoja_vida('+row.id_personal+')"> <span class="text-bold"> <i  class="far fa-file-pdf"></i> &nbsp; Hoja De Vida </span>  </a></li><li><a href="#" onclick="Aprobrar_th('+row.id_solicitud_contrato+',\''+row.aspirante+'\');"> <span  class="text-bold"> <i class="fas fa-check"></i> &nbsp; Aprobar </span> </a></li> <li><a href="#" onClick="rechazar_talento_humano('+row.id_solicitud_contrato+',\''+row.aspirante+'\')"> <span class="text-bold"> <i class="fas fa-times"></i> &nbsp; Rechazar </span> </a></li> </ul></div></span>';
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
            }
        ],
    });

}

function CargarAprobadas_th(id_dpto){
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
            "url":"cTalento_humano_as/AprobadasTalentoHumano",
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
            {"data":"codigo"},
            {"data":  null,"width": "13%"},
            {"data": 'departamento'},
            {"data": 'cordinador'},
            {"data": 'fecha_solicitud'},
            {"data": 't_contrato'},
            {"data":  null},
            {"data": 'observacion'},
            {"data":  null,render:function(row){
                return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li><a href="#" onClick="Generar_hoja_vida('+row.id_personal+')"> <span class="text-bold"> <i class="far fa-file-pdf"></i>&nbsp; Hoja de Vida</span> </a></li><li><a href="#" data-toggle="modal" data-target="#md_proc_solic_y_contr" onClick="ProcesosSolicitudContrato('+row.id_solicitud_contrato+');"> <span class="text-bold"><i class="fas fa-eye"></i>&nbsp; Ver Proceso </span>  </a></li> <li> <a href="#"  onclick="DeshacerProceso('+row.id_solicitud_contrato+',\''+row.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li>  </ul></div></span>';
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
            }
        ],
        "order": [[3,"asc"]],
    });
}

function CargaRechazadas_th(id_dpto) {
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
            {"data":"codigo"},
            {"data": null,"width": "13%"},
            {"data":'departamento'},
            {"data":'cordinador'},
            {"data":'fecha_solicitud'},
            {"data":'t_contrato'},
            {"data":null},
            {"data":'observacion'},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [1],
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
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')">  <span class="text-bold"> <i class="far fa-file-pdf"></i>&nbsp; Hoja de Vida</span>  </a></li><li><a href="#" class="info_rechazada"> <span class="text-bold"> <i class="fa fa-info"></i> &nbsp; info </span> </a></li>  <li> <a href="#"  onclick="DeshacerProceso('+data.id_solicitud_contrato+',\''+data.aspirante+'\')"> <span  class="text-bold"> <i class="fas fa-sync-alt"></i> &nbsp; Deshacer Proceso  </span> </a> </li>  </ul></div></span>';

                }
            }
        ]
    });
}

function DeshacerProceso(id_solicitud,aspirante) {
    $.post("cTalento_humano_as/Verifica",{'id_solicitud':id_solicitud},function (res) {
        if( res.count ==='0'){
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
                $.post("cTalento_humano_as/Deshacer",{'id_solicitud':id_solicitud},function(data){
                    if(data == 1){
                        $('#tblLisAspFluProc').DataTable().ajax.reload();
                        $('#tblSolicitudesRechazadas').DataTable().ajax.reload();
                        toastr.info('Se Realizo Correctamente !!!');
                    }else if( data == 0){
                        toastr.error('No Se Realizo Correctamente !!!');
                    }

                },'json');
            },function (dismiss){});
        }else{
            toastr.error('OPERACION NO DISPONIBLE');
        }
    },'json');

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
        $.post("cTalento_humano_as/AprobarSolicitud_th",{'Id_sol_contratoTH':idsolicitud},function(data){
               if(data.fnc_aprobar_recursos_humano ==='OK'){
                   toastr.info('Solicitud de: '+aspirante+' '+data.fnc_aprobar_recursos_humano);
                   $('#tblLisAspPorAproTH').DataTable().ajax.reload();
                   $('#tblLisAspFluProc').DataTable().ajax.reload();
                   //CargarListaSolicitud_th();
                   //CargarAprobadas_th();
               }
        },'json');
    },function (dismiss){});
}

//Con esta función rechazamos la solicitud (Cambiar el estado de la aprobación de talento humano)
function rechazar_talento_humano(IdSolContrato, aspirante){
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
        $.post("cTalento_humano_as/RechazarSolicitudTalentoHumano",{Id_sol_contrato:IdSolContrato,observa:observacion},function(data,estado){
            if (estado === 'success'){
                if (data.fnc_rechazar_solicitud_talento_humano === 'OK') {
                    toastr.info('Solicitud de: '+aspirante+' rechazada correctamente.');
                    $('#tblLisAspPorAproTH').DataTable().ajax.reload();
                    $('#tblLisAspFluProc').DataTable().ajax.reload();
                    $('#tblSolicitudesRechazadas').DataTable().ajax.reload();
                }
            }

        },'json');
    });
}

function ProcesosSolicitudContrato(IdSolicitudContrato){
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
            "url":"cTalento_humano_as/ProcesoSolicitud",
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


