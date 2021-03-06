$(document).ready(function(){
    $('[data-toggle ="tooltip"]').tooltip();  //Para los tooltips
    toastr.options = {
        closeButton:true,
        positionClass: "toast-top-right",
        preventDuplicates: true
    };
    $('#cbodepartamentotalhum').select2({theme:"bootstrap"});
    $('#mtxtFecIni').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true, startDate: '0d'}); 
    $('#mtxtFecFin').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true, startDate: '0d'});
    $('#mtxtFecIni').keypress(function (evt) {  return false; });
    $('#mtxtFecFin').keypress(function (evt) {  return false; });
    $('#mtxtFecIniAdmin').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true, startDate: '0d'}); 
    $('#mtxtFecFinAdmin').datepicker({format: 'yyyy-mm-dd',language:'es',autoclose: true, startDate: '0d'});
    $('#mtxtFecIniAdmin').keypress(function (evt) {  return false; });
    $('#mtxtFecFinAdmin').keypress(function (evt) {  return false; });

    CargaCombo_Denom_Doc('#mcboCategoria',74);
    CargaCombo_Denom_Doc('#mcboRegLaboral',65);
    CargaCombo_Denom_Doc('#mcboRegLaboralAdmin',65);

    console.log('Se cargaron los aspirantes para el proceso de talento humano');

    //Llenar combo cbodepartamentotalhum
    $.post("cTalento_humano/GetListadoDepartamentos",function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#cbodepartamentotalhum').append('<option value="'+item.iddepartamento+'">'+item.nombre+'</option>')
            });
        });

    tbl_tal_humano_depto();

    //LLenar tabla de acuerdo a lo que se selecciona en el combo cbodepartamentotalhum
    $('#cbodepartamentotalhum').change(function () {
        $('#tblTalHumano').DataTable().destroy();
        if($('#cbodepartamentotalhum').val()==-3){
            tbl_tal_humano_all_depto();
        }
        else{
            tbl_tal_humano_depto();
        }
    });

    //Evento change del combo mcboCategoria
    $('#mcboCategoria').change(function () {
        if($('#mcboCategoria').val()===''){
            LimpiarNivDedRMU();
        }
        else{
            LimpiarNivDedRMU();
            CargaNivel();
        }
    });

    //Evento change del combo mcboNivel
    $('#mcboNivel').change(function () {
        if($('#mcboNivel').val()===''){
            LimpiarDedRMU();
        }
        else{
            LimpiarDedRMU();
            CargaDedicacion();
        }
    });

    //Evento change del combo mcboDedicacion
    $('#mcboDedicacion').change(function () {
        if($('#mcboDedicacion').val()==''){
            $('#mtxtRMU').val('');
            $('#mtxtAbreviatura').val('');
        }
        else{
            CargaRemuneracion();
        }
    });

    $('#mbtnProcRRHH').click(function (e) {
        e.preventDefault();
        if($('#form_pro_rrhh').smkValidate()){
            if($('#mtxtFecIni').val()>=$('#mtxtFecFin').val()){
                toastr.error('La fecha de inicio no puede ser mayor o igual a la fecha de fin');
            }
            else{
                alertify.confirm('Procesar contrato', '¿Está seguro(a) de querer procesar el contrato de: '+$('#mtxtAspirante').val()+'?',
                    function(){
                        if($('#mcboFormProfesional').val()===''){
                            idFP=-1;
                        }
                        else{
                            idFP=$('#mcboFormProfesional').val();
                        }
                        $.post("cTalento_humano/ProcesarSolicitudRRHH",
                            {
                                IdContrato:$('#mhdnIdContProRRHH').val(),
                                IdForPro:idFP,  //$('#mcboFormProfesional').val(),
                                IdRegLab:$('#mcboRegLaboral').val(),
                                IdDenoDocen:$('#mhdnIdDenoDocenProRRHH').val(),
                                RMU:$('#mtxtRMU').val(),
                                FecIni:$('#mtxtFecIni').val(),
                                FecFin:$('#mtxtFecFin').val(),
                                NumMeses:$('#mtxtNumMeses').val()
                            },
                            function(data){
                                var res=JSON.parse(data);
                                if (res.fnc_proceso_rrhh == 'OK') {
                                    toastr.success('Contrato de: '+$('#mtxtAspirante').val()+' procesado correctamente.');
                                    $('#btn_cerrar_modalRH').click();
                                    $('#tblTalHumano').DataTable().ajax.reload();
                                    $('#tblLisAspFluProc').DataTable().ajax.reload();
                                }
                            });
                    },
                    function(){
                    });
            }
        }
    })

    $('#btn_cerrar_modalRH').click(function () {
        $('#mtxtFecIni').datepicker('setDate', null);
        $('#mtxtFecFin').datepicker('setDate', null);
        $('#form_pro_rrhh').smkClear();
        LimpiarNivDedRMU();
        //$('#form_pro_rrhh')[0].reset();
    });

    $('#btn_cerrar_modalRHAdmin').click(function () {
        $('#mtxtFecIniAdmin').datepicker('setDate', null);
        $('#mtxtFecFinAdmin').datepicker('setDate', null);
        $('#form_pro_rrhhAdmin').smkClear();
    });

});

//FUNCIONES
//Aquí se llena la tabla Lista de Aspirantes para el proceso de talento humano de algún departamento en específico con datatables
function tbl_tal_humano_depto() {
    $('#tblTalHumano').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cTalento_humano/GetListProRRHHDepto",
            "type":"POST",
            "data":{
                id_cbo_dpto_pro_rrhh:$('#cbodepartamentotalhum').val()
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
            {data: 'apellido1','sClass':'dt-body-center'},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 'estado_rh'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    if (row.t_contrato === 'DOCENTE') {
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#modalProSolRRHH" onClick="selAspProRRHH(\''+row.idcontrato+'\',\''+row.idpersonal+'\',\''+row.dedicacion+'\',\''+row.observacion+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\',\''+row.t_contrato+'\');"><i style="color:black;" class="fa fa-gears"></i> Procesar contrato</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                    }
                    else if(row.t_contrato === 'ADMINISTRATIVO'){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#modalProSolRRHHAdmin" onClick="selAspProRRHHAdministrativo(\''+row.idcontrato+'\',\''+row.idpersonal+'\',\''+row.puesto+'\',\''+row.observacion+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\',\''+row.t_contrato+'\');"><i style="color:black;" class="fa fa-gears"></i> Procesar contrato</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                    }
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
                "data": "estado_rh",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>PENDIENTE</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Aquí se llena la tabla Lista de Aspirantes para el proceso de talento humano de todos los departamentos con datatables
function tbl_tal_humano_all_depto() {
    $('#tblTalHumano').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse": true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        'ajax': {
            "url":"cTalento_humano/GetListProRRHHAllDepto",
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
            {data: 'apellido1','sClass':'dt-body-center'},
            {data: 'departamento'},
            {data: 'nom_coordinador'},
            {data: 'fecha'},
            {data: 't_contrato'},
            {data: 'categoria'},
            {data: 'estado_rh'},
            {"orderable": false, 'searchable':false,
                render:function(data, type, row){
                    if (row.t_contrato === 'DOCENTE') {
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#modalProSolRRHH" onClick="selAspProRRHH(\''+row.idcontrato+'\',\''+row.idpersonal+'\',\''+row.dedicacion+'\',\''+row.observacion+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\',\''+row.t_contrato+'\');"><i style="color:black;" class="fa fa-gears"></i> Procesar contrato</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                    }
                    else if(row.t_contrato === 'ADMINISTRATIVO'){
                        return '<span class="pull-left">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    <i class="fa fa-list"></i>' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5">' +
                            '    <li><a href="#" onClick="updEstadoAfiliado('+row.idaspirante+','+1+')"><i style="color:black;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li>' +
                            '    <li><a href="#" data-toggle="modal" data-target="#modalProSolRRHHAdmin" onClick="selAspProRRHHAdministrativo(\''+row.idcontrato+'\',\''+row.idpersonal+'\',\''+row.puesto+'\',\''+row.observacion+'\',\''+row.apellido1+'\',\''+row.apellido2+'\',\''+row.nombres+'\',\''+row.cedula+'\',\''+row.t_contrato+'\');"><i style="color:black;" class="fa fa-gears"></i> Procesar contrato</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';
                    }
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
                "data": "estado_rh",
                "render": function(data, type, row) {
                    if (data == 'P') {
                        return "<span class='label label-warning'>PENDIENTE</span>";
                    }
                }
            },
        ],
        "order": [[3,"asc"]],
    });
}

//Con esta función pasamos los parámetros al modal (DOCENTE).
selAspProRRHH = function(idCont, idPersonal, dedi, obs, app, apm, nom, ced, TContrato){
    $('#mhdnIdContProRRHH').val(idCont);
    $('#mtxtAspirante').val(app+' '+apm+' '+nom+'  -  '+ced);
    $('#mtxtReqDedi').val(dedi);
    $('#mtxtObservacion').val(obs);
    //Llenar combo mcboFormProfesional
    $('#mcboFormProfesional  option').remove();
    $('#mcboFormProfesional').append('<option value="">Seleccione la profesión</option>');
    $.post("cTalento_humano/GetListProfesiones",
        {
        IdPersonal:idPersonal
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#mcboFormProfesional').append('<option value="'+item.idformacion_profesional+'">'+item.titulo_obtenido+'</option>')
            });
        });
    if(TContrato ==='DOCENTE'){
        $('#mcboRegLaboral').val(2526).prop('selected','selected');
    }
};

//Con esta función pasamos los parámetros al modal (ADMINISTRATIVO).
selAspProRRHHAdministrativo = function(idCont, idPersonal, puesto, obs, app, apm, nom, ced, TContrato){
    $('#mhdnIdContProRRHHAdmin').val(idCont);
    $('#mtxtAspiranteAdmin').val(app+' '+apm+' '+nom+'  -  '+ced);
    $('#mtxtObservacionAdmin').val(obs);
    //Llenar combo mcboFormProfesionalAdmin
    $('#mcboFormProfesionalAdmin  option').remove();
    $('#mcboFormProfesionalAdmin').append('<option value="">Seleccione la profesión</option>');
    $.post("cTalento_humano/GetListProfesiones",
        {
        IdPersonal:idPersonal
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#mcboFormProfesionalAdmin').append('<option value="'+item.idformacion_profesional+'">'+item.titulo_obtenido+'</option>')
            });
        });
    if(TContrato ==='ADMINISTRATIVO'){
        $('#mcboRegLaboralAdmin').val(2579).prop('selected','selected');
    }
    $('#mtxtPuesto').val(puesto);
};

function CargaCombo_Denom_Doc(combo,id) {
    $.post("cTalento_humano/GetListTipo",
        {
        Id_Cat_tipo:id
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $(combo).append('<option value="'+item.idtipo+'">'+item.nombre+'</option>')
            });
        });
}

function CargaNivel() {
    $.post("cTalento_humano/GetListNivel",
        {
            Id_Cat:$('#mcboCategoria').val()
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#mcboNivel').append('<option value="'+item.idtipo+'">'+item.nombre+'</option>')
            });
        });
}

function CargaDedicacion() {
    $.post("cTalento_humano/GetListDedicacion",
        {
            Id_Cat:$('#mcboCategoria').val(),
            Id_Niv:$('#mcboNivel').val()
        },
        function(data){
            var d = JSON.parse(data);
            $.each(d,function(i,item){
                $('#mcboDedicacion').append('<option value="'+item.idtipo+'">'+item.nombre+'</option>')
            });
        });
}

function CargaRemuneracion() {
    $.post("cTalento_humano/GetRemuneracion",
        {
            Id_Cat:$('#mcboCategoria').val(),
            Id_Niv:$('#mcboNivel').val(),
            Id_Ded:$('#mcboDedicacion').val()
        },
        function(data){
            var d = JSON.parse(data);
            $('#mtxtRMU').val(d[0].rmu)
            $('#mtxtAbreviatura').val(d[0].abrevia)
            $('#mhdnIdDenoDocenProRRHH').val(d[0].id_denominacion_docente)
        });
}

function LimpiarNivDedRMU() {
    $('#mcboNivel  option').remove();
    $('#mcboNivel').append('<option value="">Seleccione el nivel</option>');
    $('#mcboDedicacion  option').remove();
    $('#mcboDedicacion').append('<option value="">Seleccione la dedicación</option>');
    $('#mtxtRMU').val('');
    $('#mtxtAbreviatura').val('');
}

function LimpiarDedRMU() {
    $('#mcboDedicacion  option').remove();
    $('#mcboDedicacion').append('<option value="">Seleccione la dedicación</option>');
    $('#mtxtRMU').val('');
    $('#mtxtAbreviatura').val('');
}
