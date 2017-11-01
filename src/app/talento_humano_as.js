$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips
    $('#cbodepartamentoaproth').select2({theme:"bootstrap"});
    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };

    console.log('Se cargaron los aspirantes por aprobar en recursos humanos');

    //Llenar combo cbodepartamentoaproth
    $.post("cTalento_humano_as/GetListadoDepartamentos",function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodepartamentoaproth').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
        });

    tbl_asp_x_aprobarTH_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentoaproth
    $('#cbodepartamentoaproth').change(function () {
        $('#tblLisAspPorAproTH').DataTable().destroy();
        if($('#cbodepartamentoaproth').val()== -3){
            tbl_asp_x_aprobarTH_all_depto();
        }
        else{
            tbl_asp_x_aprobarTH_depto();
        }
    });

});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes por aprobar en talento humano de algún departamento en específico con datatables
function tbl_asp_x_aprobarTH_depto() {
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
            "url":"cTalento_humano_as/GetListAspXAproTHDepto",
            "type":"POST",
            "data":{
                id_cbo_dpto_x_apro_th:$('#cbodepartamentoaproth').val()
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
            {data: 'apellido1','sClass':'dt-body-center',"width": "20%"},
            {data: 'departamento',"width": "15%"},
            {data: 'nom_coordinador',"width": "17%"},
            {data: 'fecha',"width": "15%"},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 't_contrato',"width": "13%"},
            {data: 'observacion'},
            {data: 'estado_apro_th'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_apro_rec == 'P') {
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-list"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                        '    <li><a href="#" onClick="updEstAproTH('+row.id_solicitud_contrato+','+row.id_personal+','+row.id_tipo_solicitud+',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\')"><i style="color:green;" class="glyphicon glyphicon-ok"></i> Aprobar</a></li>' +
                        '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:red;" class="glyphicon glyphicon-remove"></i> Rechazar</a></li>' +
                        '    </ul>' +
                        '</div>' +
                        '</span>';
                    //}
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],
                "data": "apellido1",
                "render": function(data, type, row) {
                    return "<div class='idAspApro' id="+row.id_solicitud_contrato+"></div>" +
                        "<span><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [1],
                "data": "departamento",
                "render": function(data, type, row) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [2],
                "data": "nom_coordinador",
                "render": function(data, type, row) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data, type, row) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [6],
                "data": "t_contrato",
                "render": function(data, type, row) {
                    if (data === 'DOCENTE') {
                        return "<span>"+row.dedicacion+"</span>";
                    }
                    else if(data === 'ADMINISTRATIVO'){
                        return "<span>"+row.puesto+"</span>";
                    }
                }
            },
            {
                "targets": [8],
                "data": "estado_apro_th",
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

//Aquí se llena la tabla Lista de Aspirantes por aprobar en talento humano de todos los departamentos con datatables
function tbl_asp_x_aprobarTH_all_depto() {
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
            "url":"cTalento_humano_as/GetListAspXAproTHAllDepto",
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
            {data: 'apellido1','sClass':'dt-body-center',"width": "20%"},
            {data: 'departamento',"width": "15%"},
            {data: 'nom_coordinador',"width": "17%"},
            {data: 'fecha',"width": "15%"},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 't_contrato',"width": "13%"},
            {data: 'observacion'},
            {data: 'estado_apro_th'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_apro_rec == 'P') {
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-list"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                        '    <li><a href="#" onClick="updEstAproTH('+row.id_solicitud_contrato+','+row.id_personal+','+row.id_tipo_solicitud+',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\')"><i style="color:green;" class="glyphicon glyphicon-ok"></i> Aprobar</a></li>' +
                        '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:red;" class="glyphicon glyphicon-remove"></i> Rechazar</a></li>' +
                        '    </ul>' +
                        '</div>' +
                        '</span>';
                    //}
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],
                "data": "apellido1",
                "render": function(data, type, row) {
                    return "<div class='idAspApro' id="+row.id_solicitud_contrato+"></div>" +
                        "<span><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [1],
                "data": "departamento",
                "render": function(data) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [2],
                "data": "nom_coordinador",
                "render": function(data) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data) {
                    return "<span>"+data+"</span>";
                }
            },
            {
                "targets": [6],
                "data": "t_contrato",
                "render": function(data, type, row) {
                    if (data === 'DOCENTE') {
                        return "<span>"+row.dedicacion+"</span>";
                    }
                    else if(data === 'ADMINISTRATIVO'){
                        return "<span>"+row.puesto+"</span>";
                    }
                }
            },
            {
                "targets": [8],
                "data": "estado_apro_th",
                "render": function(data) {
                    if (data ==='P') {
                        return "<span class='label label-warning'>PENDIENTE</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Con esta función aprobamos la solicitud (Cambiar el estado de la solicitud - talento humano)
updEstAproTH = function(IdSolContrato, IdContratado, IdTipoSol, apellidop, apellidom, nombres){
    alertify.confirm('Aprobar solicitud', '¿Está seguro(a) de querer aprobar la solicitud del aspirante: '+apellidop+' '+apellidom+' '+nombres+'?',
        function(){
            $.post("cTalento_humano_as/AprobarSolicitudTH",
                {
                    Id_sol_contratoTH:IdSolContrato,
                    Id_contratado:IdContratado,
                    Id_tipo_sol:IdTipoSol
                },
                function(data){
                    var res=JSON.parse(data);
                    if (res.p_opcion === '1') {
                        toastr.success('Solicitud de: '+apellidop+' '+apellidom+' '+nombres+res.p_mensaje);
                        $('#tblLisAspPorAproTH').DataTable().ajax.reload();
                        //$('#tblLisAspFluProc').DataTable().ajax.reload();
                    }
                });
        },
        function(){
        });
};
