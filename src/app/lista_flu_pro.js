$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips

    toastr.options = {
        closeButton:true,
        positionClass: "toast-bottom-right",
        //positionClass:"toast-top-right",
        preventDuplicates: true
    };

    console.log('Se cargó el flujo de procesos de los aspirantes');

    //Llenar combo cbodepartamentoflu
    $.post("cRectorado/GetListadoDepartamentos",
        {
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodepartamentoflu').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
        });

    tbl_lis_asp_flu_pro_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentoflu
    $('#cbodepartamentoflu').change(function () {
        $('#tblLisAspFluProc').DataTable().destroy();
        if($('#cbodepartamentoflu').val()== -3){
            tbl_lis_asp_flu_pro_all_depto();
        }
        else{
            tbl_lis_asp_flu_pro_depto();
        }
    });

});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes Flujo de Procesos de algún departamento en específico con datatables
function tbl_lis_asp_flu_pro_depto() {
    $('#tblLisAspFluProc').DataTable({
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "Todos"]],
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
            "url":"cRectorado/GetListAspFluProDpto",
            //"url":baseurl+"cRectorado/GetListadoAspirantes",
            "type":"POST",
            "data":{
                id_cbo_dpto_flu:$('#cbodepartamentoflu').val()
                // 	"p1":p1
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
            {data: 'estado_apro_rec'},
            {data: 'estado_apro_th'},
            {data: 'estado_rh'},
            {data: 'estado_fin'},
            {data: 'estado_rhf'},
            {data: 'estado_fr'},
            {data: 'estado_fc'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-bars"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Ver hoja de vida" onClick="updEstadoAfiliado('+row.idaspirante+','+2+')"><i style="color:black;" class="fa fa-eye"></i> Hoja de vida</a></li>' +
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
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'A') {
                        return "<span class='label label-success'>Aceptada</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuarioar+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_apro_rec+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_apro_rec+"</span>";
                    }
                }
            },
            {
                "targets": [6],
                "data": "estado_apro_th",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'A') {
                        return "<span class='label label-success'>Aceptada</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuarioarh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_apro_th+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_apro_th+"</span>";
                    }
                }
            },
            {
                "targets": [7],
                "data": "estado_rh",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariorh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_rh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_rh+"</span>";
                    }
                }
            },
            {
                "targets": [8],
                "data": "estado_fin",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofi+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fi+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fi+"</span>";
                    }
                }
            },
            {
                "targets": [9],
                "data": "estado_rhf",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariorhf+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_rhf+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_rhf+"</span>";
                    }
                }
            },
            {
                "targets": [10],
                "data": "estado_fr",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofr+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fr+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fr+"</span>";
                    }
                }
            },
            {
                "targets": [11],
                "data": "estado_fc",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofc+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fc+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fc+"</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Lista de Aspirantes Flujo de Procesos de todos los departamentos con datatables
function tbl_lis_asp_flu_pro_all_depto() {
    $('#tblLisAspFluProc').DataTable({
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "Todos"]],
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
            "url":"cRectorado/GetListAspFluProAllDpto",
            //"url":baseurl+"cRectorado/GetListadoAspirantes",
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
            {data: 'estado_apro_rec'},
            {data: 'estado_apro_th'},
            {data: 'estado_rh'},
            {data: 'estado_fin'},
            {data: 'estado_rhf'},
            {data: 'estado_fr'},
            {data: 'estado_fc'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-bars"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Ver hoja de vida" onClick="updEstadoAfiliado('+row.idaspirante+','+2+')"><i style="color:black;" class="fa fa-eye"></i> Hoja de vida</a></li>' +
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
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'A') {
                        return "<span class='label label-success'>Aceptada</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuarioar+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_apro_rec+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_apro_rec+"</span>";
                    }
                }
            },
            {
                "targets": [6],
                "data": "estado_apro_th",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'A') {
                        return "<span class='label label-success'>Aceptada</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuarioarh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_apro_th+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_apro_th+"</span>";
                    }
                }
            },
            {
                "targets": [7],
                "data": "estado_rh",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariorh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_rh+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_rh+"</span>";
                    }
                }
            },
            {
                "targets": [8],
                "data": "estado_fin",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofi+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fi+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fi+"</span>";
                    }
                }
            },
            {
                "targets": [9],
                "data": "estado_rhf",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariorhf+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_rhf+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_rhf+"</span>";
                    }
                }
            },
            {
                "targets": [10],
                "data": "estado_fr",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofr+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fr+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fr+"</span>";
                    }
                }
            },
            {
                "targets": [11],
                "data": "estado_fc",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }else if (data == 'T') {
                        return "<span class='label label-success'>Terminado</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-user-circle'></i>"+': '+" "+row.usuariofc+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-calendar'></i>"+': '+" "+row.fecha_fc+"</span><br>"+
                            "<span style='color:#555;'><i class='fa fa-clock-o'></i>"+': '+" "+row.hora_fc+"</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}