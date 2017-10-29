$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Para los tooltips
    toastr.options = {
        closeButton:true,
        positionClass: "toast-bottom-right",
        //positionClass:"toast-top-right",
        preventDuplicates: true
    };
    $('#cbodepartamentoapro').select2({theme:"bootstrap"});

    /*$('#tblLisAspPorApro').on('draw.dt', function() {
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_flat-blue'
    });
    });*/

    console.log('Se cargaron los aspirantes por aprobar');

    //Llenar combo cbodepartamentoapro
    $.post("cRectorado/GetListadoDepartamentos",function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodepartamentoapro').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
    });

    tbl_asp_x_aprobar_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentoapro
    $('#cbodepartamentoapro').change(function () {
        $('#tblLisAspPorApro').DataTable().destroy();
        if($('#cbodepartamentoapro').val()== -3){
            tbl_asp_x_aprobar_all_depto();
        }
        else{
            tbl_asp_x_aprobar_depto();
        }
    });

    //Aprobar masivamente
    $('#btn_apro_mas').click(function (e) {
        e.preventDefault();
        if($('#spNumSolApro').html()!=0){
            alertify.confirm('Aprobar masivamente', '¿Está seguro(a) de querer aprobar masivamente la(s) '+$('#spNumSolApro').html()+' solicitud(es) seleccionada(s)?',
                function(){
                    var cont=0;
                    //console.log("Cantidad de elementos: "+$('#tblLisAspPorApro').DataTable().data().length);
                    $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
                        $(this).children('td').each(function(indiceColumna) {
                            if(indiceColumna == 6){
                                if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                                    var idAspAp = $('.idAspApro:eq('+indiceFila+')').prop('id');
                                    updEstAproRecParaMasiv(idAspAp)
                                    cont++;
                                    //console.log("Checkbox seleccionado: "+idAspAp);
                                }
                            }
                        });
                    });
                    toastr.success(cont+' Solicitud(es) aprobada(s) exitosamente.');

                    setTimeout(function () {

                    //LLenar tabla de acuerdo a lo que hay en el combo en la vista Solicitudes por aprobar
                    if($('#cbodepartamentoapro').val()== -3){
                        $('#tblLisAspPorApro').DataTable().destroy();
                        tbl_asp_x_aprobar_all_depto();
                    }
                    else{
                        $('#tblLisAspPorApro').DataTable().destroy();
                        tbl_asp_x_aprobar_depto();
                    }

                    //Poner en el combo "Seleccione el departamento" en la vista Flujo de procesos para la elaboración de un nuevo contrato
                    $('#cbodepartamentoflu  option[value="-2"]').prop('selected',true);
                    $('#tblLisAspFluProc').DataTable().destroy();
                    tbl_lis_asp_flu_pro_depto();

                    },1000);
                },
                function(){
                });
        }
        else{
            toastr.error('No hay solicitud(es) seleccionada(s)');
        }

    })

    //Cuando den clic en algún checkbox, contabilice las solicitudes seleccionadas y las muestre
    $('#tblLisAspPorApro').on('click', 'input[type="checkbox"]', function() {
        //console.log('best', 'click');
        var cont=0;
        $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
            $(this).children('td').each(function(indiceColumna) {
                if(indiceColumna == 6){
                    if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                        cont++;
                    }
                }
            });
        });
        $('#spNumSolApro').html(cont);
    });

    //Cuando busquen, contabilice las solicitudes seleccionadas en pantalla y las muestre
    $('#tblLisAspPorApro').on('search.dt', function() {
        $('#tblLisAspPorApro').on('draw.dt', function() {
            var cont=0;
            $('#tblLisAspPorApro tbody tr').each(function(indiceFila) {
                $(this).children('td').each(function(indiceColumna) {
                    if(indiceColumna == 6){
                        if ($('.checkboxstabla:eq('+indiceFila+')').prop('checked')) {
                            cont++;
                        }
                    }
                });
            });
            $('#spNumSolApro').html(cont);
        });
    });

});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes por aprobar de algún departamento en específico con datatables
function tbl_asp_x_aprobar_depto() {
    $('#tblLisAspPorApro').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cRectorado/GetListAspXAproDepto",
            "type":"POST",
            "data":{
                id_cbo_dpto_x_apro:$('#cbodepartamentoapro').val()
            },
            "dataSrc": function(data){
                //alert(data[1].nombres);
                var suma = 0;
                for (var i = 0; i <= data.length - 1; i++) {
                    suma += 1;
                }
                $('#spNumSolApro').html(suma);
                return data;
            },
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
            {data: 'apellido1','sClass':'dt-body-center',"width": "20%"},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'estado_apro_rec'},
            {data: 'estado_apro_rec', 'searchable':false, "orderable": false},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_apro_rec == 'P') {
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-bars"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Aprobar solicitud" onClick="updEstAproRector('+row.id_solicitud_contrato+',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\')"><i style="color:green;" class="glyphicon glyphicon-ok"></i> Aprobar</a></li>' +
                            '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Rechazar solicitud" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:red;" class="glyphicon glyphicon-remove"></i> Rechazar</a></li>' +
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
                    return "<span><i class='fa fa-institution'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [2],
                "data": "nom_coordinador",
                "render": function(data, type, row) {
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data, type, row) {
                    return "<span><i class='fa fa-calendar'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [5],
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }
                }
            },
            {
                "targets": [6],
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<input class='checkboxstabla' id=\"checkbox1\" name=\"checkbox1\" type=\"checkbox\" checked>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Lista de Aspirantes por aprobar de todos los departamentos con datatables
function tbl_asp_x_aprobar_all_depto() {
    $('#tblLisAspPorApro').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cRectorado/GetListAspXAproAllDepto",
            "type":"POST",
            "dataSrc": function(data){
                //alert(data[1].nombres);
                var suma = 0;
                for (var i = 0; i <= data.length - 1; i++) {
                    suma += 1;
                }
                $('#spNumSolApro').html(suma);
                return data;
            },
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
            {data: 'apellido1','sClass':'dt-body-center',"width": "20%"},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'estado_apro_rec'},
            {data: 'estado_apro_rec', 'searchable':false, "orderable": false},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    //if (row.estado_apro_rec == 'P') {
                    return '<span class="pull-left">' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '    <i class="fa fa-bars"></i>' +
                        '  <span class="caret"></span>' +
                        '  </button>' +
                        '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                        '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Aprobar solicitud" onClick="updEstAproRector('+row.id_solicitud_contrato+',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\')"><i style="color:green;" class="glyphicon glyphicon-ok"></i> Aprobar</a></li>' +
                        '    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Rechazar solicitud" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:red;" class="glyphicon glyphicon-remove"></i> Rechazar</a></li>' +
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
                    return "<span><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [3],
                "data": "fecha",
                "render": function(data, type, row) {
                    return "<span><i class='fa fa-calendar'></i> &nbsp;"+data+"</span>";
                }
            },
            {
                "targets": [5],
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data === 'P') {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }
                }
            },
            {
                "targets": [6],
                "data": "estado_apro_rec",
                "render": function(data, type, row) {
                    if (data === 'P') {
                        return "<input class='checkboxstabla' id='checkbox1' name='checkbox1' type='checkbox' checked>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Con esta función aprobamos la solicitud (Cambiar el estado de la aprobación del rector)
updEstAproRector = function(IdSolContrato, apellidop, apellidom, nombres){
    alertify.confirm('Aprobar solicitud', '¿Está seguro(a) de querer aprobar la solicitud del aspirante: '+apellidop+' '+apellidom+' '+nombres+'?',
        function(){
            $.post("cRectorado/AprobarSolicitud",
                {
                    Id_sol_contrato:IdSolContrato
                },
                function(data){
                    var res=JSON.parse(data);
                    if (res.fnc_upd_apro_rec === 'OK') {
                        toastr.success('Solicitud de: '+apellidop+' '+apellidom+' '+nombres+' aprobada correctamente.');
                        $('#tblLisAspPorApro').DataTable().ajax.reload();
                        $('#tblLisAspFluProc').DataTable().ajax.reload();
                    }
                });
        },
        function(){
        });
};

//Con esta función aprobamos masivamente las solicitudes (Cambiar el estado de la aprobación del rector)
updEstAproRecParaMasiv = function(IdSolContrato){
            $.post("cRectorado/AprobarSolicitud",
                {
                    Id_sol_contrato:IdSolContrato
                });
};