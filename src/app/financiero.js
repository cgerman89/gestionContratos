$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips
    toastr.options = {
        closeButton:true,
        positionClass: "toast-bottom-right",
        //positionClass:"toast-top-right",
        preventDuplicates: true
    };

    console.log('Se cargaron los aspirantes para el proceso de financiero');

    //Llenar combo cbodepartamentofinan
    $.post("cFinanciero/GetListadoDepartamentos",
        {
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodepartamentofinan').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
        });

    tbl_financiero_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentofinan
    $('#cbodepartamentofinan').change(function () {
        $('#tblFinanciero').DataTable().destroy();
        if($('#cbodepartamentofinan').val()== -3){
            tbl_financiero_all_depto();
        }
        else{
            tbl_financiero_depto();
        }
    });

});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes para el proceso de financiero de algún departamento en específico con datatables
function tbl_financiero_depto() {
    $('#tblFinanciero').DataTable({
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'responsive':true,
        'stateSave': true,
        'scrollX':true,
        "autoWidth":false,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cFinanciero/GetListProFinanDepto",
            "type":"POST",
            "data":{
                id_cbo_dpto_pro_finan:$('#cbodepartamentofinan').val()
            },
            "dataSrc": '',
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                setTimeout(function () {
                    swal.closeModal();
                },1000);
            }
        },
        'columns': [
            {data: 'apellido1','sClass':'dt-body-center'},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'estado_fin'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_rh == 'P') {
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-bars"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" title="Ver hoja de vida" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-eye"></i> Hoja de vida</a></li>' +
                        '    <li><a href="#" title="Procesar solicitud" data-toggle="modal" data-target="#modalProSolRRHH" onClick="selAspProRRHH(\''+row.idcontrato+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\');"><i style="color:green;" class="fa fa-gears"></i> Procesar</a></li>' +
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
                    return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span style='color:#555;'><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [1],
                "data": "departamento",
                "render": function(data, type, row) {
                    return "<span style='color:#006699;'><i class='fa fa-institution'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [2],
                "data": "nom_coordinador",
                "render": function(data, type, row) {
                    return "<span style='color:#555;'><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data, type, row) {
                    return "<span style='color:#006699;'><i class='fa fa-calendar'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [5],
                "data": "estado_fin",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Lista de Aspirantes para el proceso de financiero de todos los departamentos con datatables
function tbl_financiero_all_depto() {
    $('#tblFinanciero').DataTable({
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'responsive':true,
        'stateSave': true,
        'scrollX':true,
        "autoWidth":false,
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cFinanciero/GetListProFinanAllDepto",
            "type":"POST",
            "dataSrc": '',
            beforeSend:function () {
                swal({title: 'Espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                setTimeout(function () {
                    swal.closeModal();
                },1000);
            }
        },
        'columns': [
            {data: 'apellido1','sClass':'dt-body-center'},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'estado_fin'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_rh == 'P') {
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-bars"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" title="Ver hoja de vida" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-eye"></i> Hoja de vida</a></li>' +
                        '    <li><a href="#" title="Procesar solicitud" data-toggle="modal" data-target="#modalProSolRRHH" onClick="selAspProRRHH(\''+row.idcontrato+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\');"><i style="color:green;" class="fa fa-gears"></i> Procesar</a></li>' +
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
                    return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;"+data+" "+row.apellido2+" "+row.nombres+"</span><br>"+
                        "<span style='color:#555;'><i class='fa fa-id-card'></i> &nbsp;"+row.cedula+"</span>";
                }
            },
            {
                "targets": [1],
                "data": "departamento",
                "render": function(data, type, row) {
                    return "<span style='color:#006699;'><i class='fa fa-institution'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [2],
                "data": "nom_coordinador",
                "render": function(data, type, row) {
                    return "<span style='color:#555;'><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data, type, row) {
                    return "<span style='color:#006699;'><i class='fa fa-calendar'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [5],
                "data": "estado_fin",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}