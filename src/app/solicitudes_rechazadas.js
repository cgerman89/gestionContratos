$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };
    $('#cbodetoSolicitudesRechazadas').select2({theme:"bootstrap"});

    console.log('Se cargó el flujo de procesos de las solicitudes rechazadas');

    //Llenar combo cbodetoSolicitudesRechazadas
    $.post("cRectorado/GetListadoDepartamentos",
        {
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodetoSolicitudesRechazadas').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
        });

    tbl_flujo_procesos_solicitudes_rechazadas_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodetoSolicitudesRechazadas
    $('#cbodetoSolicitudesRechazadas').change(function () {
        $('#tblSolicitudesRechazadas').DataTable().destroy();
        if($('#cbodetoSolicitudesRechazadas').val()== -3){
            tbl_flujo_procesos_solicitudes_rechazadas_all_depto();
        }
        else{
            tbl_flujo_procesos_solicitudes_rechazadas_depto();
        }
    });

});

//FUNCIONES
//Aquí se llena la tabla Flujo de Procesos de las solicitudes rechazadas de algún departamento en específico con datatables
function tbl_flujo_procesos_solicitudes_rechazadas_depto() {
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
            "url":"cRectorado/ProcesosSolicitudesRechazadasDpto",
            "type":"POST",
            "data":{
                id_cbo_dpto_soli_recha:$('#cbodetoSolicitudesRechazadas').val()
            },
            "dataSrc": '',
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                    swal.closeModal();
            }
        },
        'columns': [
            {data: 'apellido1','sClass':'dt-body-center',"width": "13%"},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 't_contrato'},
            {data: 'observacion'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="Generar_hoja_vida('+row.idpersonal+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#md_proc_solic_y_contr_rechazadas" onClick="ProcesosSolicitudContratoRechazadas(\''+row.id_solicitud_contrato+'\');"><i class="fa fa-gears"></i> Ver Procesos</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],
                "data": "apellido1",
                "render": function(data, type, row) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [6],
                "data": "t_contrato",
                "render": function(data, type, row) {
                    if (data == 'DOCENTE') {
                        return "<span>"+row.dedicacion+"</span>";
                    }
                    else if(data == 'ADMINISTRATIVO'){
                        return "<span>"+row.puesto+"</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Flujo de Procesos de las solicitudes rechazadas de todos los departamentos con datatables
function tbl_flujo_procesos_solicitudes_rechazadas_all_depto() {
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
            "url":"cRectorado/ProcesosSolicitudesRechazadasAllDpto",
            "type":"POST",
            "dataSrc": '',
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                    swal.closeModal();
            }
        },
        'columns': [
            {data: 'apellido1','sClass':'dt-body-center',"width": "13%"},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 't_contrato'},
            {data: 'observacion'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="Generar_hoja_vida('+row.idpersonal+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#md_proc_solic_y_contr_rechazadas" onClick="ProcesosSolicitudContratoRechazadas(\''+row.id_solicitud_contrato+'\');"><i class="fa fa-gears"></i> Ver Procesos</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],
                "data": "apellido1",
                "render": function(data, type, row) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [6],
                "data": "t_contrato",
                "render": function(data, type, row) {
                    if (data == 'DOCENTE') {
                        return "<span>"+row.dedicacion+"</span>";
                    }
                    else if(data == 'ADMINISTRATIVO'){
                        return "<span>"+row.puesto+"</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

ProcesosSolicitudContratoRechazadas = function(IdSolicitudContrato){
    var num_rechazos=0;
    $('#tabla_proceso_solicitud_recha').DataTable({
        "destroy":true,
        "paging": false,
        "searching": false,
        "ordering": false,
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
                        if(num_rechazos === 1){
                            return '';
                        }
                        else{
                            return '<span class="label label-warning">PENDIENTE</span>';
                        }
                    }else if(data === 'R') {
                        ++num_rechazos;
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-info">ACEPTADA</span>';
                    }
                }
            }
        ]
    });

    $('#tabla_procesos_contrato_recha').DataTable({
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

function Generar_hoja_vida(idpersonal) {
    $('#pdf_contenedor_hv').html(
        '<div class="modal-dialog">'+
        '<div class="modal-content">'+
        '<div class="modal-header">'+
        '<button type="button"  id="btn_cerrar_md_banco" name="btn_cerrar_md_banco" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title">Hoja de Vida</h4>'+
        '</div>'+
        '<div class="modal-body" >'+
        '<div class="panel">'+
        '<div class="panel-body">'+
        '<div>'+
        '<iframe id="frame" height="650" width="100%" src="cRectorado/h_vida?id='+idpersonal+'" frameborder="0"></iframe>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'
    )
    $("#pdf_contenedor_hv").modal('show');
}
