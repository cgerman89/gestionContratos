$(document).ready(function () {
    let buscar_solicitudes = $('#buscar_solicitudes');
    let fecha_inicio_sl = $('#fecha_inicio_sl');
    let fecha_fin_sl = $('#fecha_fin_sl');
    let departamento_sl_ctr_th = $('#departamento_sl_ctr_th');
    let form_consulta_sl = $('#form_consulta_sl');
    let fecha_inicio_ctr = $('#fecha_inicio_ctr');
    let fecha_fin_ctr = $('#fecha_fin_ctr');
    let departamento_ctr_th = $('#departamento_ctr_th');
    let form_consulta_ctr = $('#form_consulta_ctr');

    CargaComboDepartamentos(departamento_sl_ctr_th);
    CargaComboDepartamentos(departamento_ctr_th);
    //departamento_sl_ctr_th.select2({theme:"bootstrap"});
    fecha_inicio_sl.datepicker({todayBtn: "linked",format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    fecha_fin_sl.datepicker({todayBtn: "linked",format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    fecha_inicio_ctr.datepicker({todayBtn: "linked",format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});
    fecha_fin_ctr.datepicker({todayBtn: "linked",format: 'yyyy-mm-dd',language:'es',autoclose:true,endDate:"0d"});

    Tabla_solicitud();
    Tabla_contratos();

    departamento_sl_ctr_th.change(function () {
        if($(this).val() !== '')
            Tabla_solicitud()
    });

    form_consulta_sl.on('change',function () {
           Tabla_solicitud();
    });

    form_consulta_ctr.on('change',function () {
        Tabla_contratos();
    });



});
function CargaComboDepartamentos(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function Tabla_solicitud(){
    $('#buscar_solicitudes').DataTable({
        "destroy":true,
        "autoWidth":false,
        "scrollCollapse":true,
        "responsive":true,
        "lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"Buscar/Get_Solicitudes",
            "data":{
                'dpto':$('#departamento_sl_ctr_th').val(),
                'f_desde':$('#fecha_inicio_sl').val(),
                'f_hasta':$('#fecha_fin_sl').val()
            },
            beforeSend:function () {

            },
            complete:function () {

            }
        },
        "columns":[
            {"data":"codigo"},
            {"data":null,"width": "23%"},
            {"data":"tipo_solicitud"},
            {"data":null},
            {"data":"fecha_solicitud","width": "7%"},
            {"data":"observacion"},
            {"data":"estado"},
            {"data": null , 'searchable':false}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render":function(data) {
                    return " <span class='text-center'> <i class='fa fa-user'></i> "+ data.aspirante+" <br><i class='fa fa-id-card'></i> "+ data.cedula_aspirante+"</span>";
                }
            },
            {
                "targets": [3],
                "render":function(data) {
                    if(data.tipo_solicitud === 'ADMINISTRATIVO'){
                        return " <span>"+ data.puesto+"</span>";
                    }else if(data.tipo_solicitud === 'DOCENTE'){
                        return " <span>"+ data.dedicacion+"</span>";
                    }

                }
            },
            {
                "targets": [6],
                "data": "estado",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PROCESO</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-primary">ACEPTADA</span>';
                    }else if (data === 'E'){
                        return '<span class="label label-danger">ANULADA</span>';
                    }else if (data === 'T'){
                        return '<span class="label label-success">TERMINADA</span>';
                    }
                }
            },
            {
                "targets": [7],
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li> <a href="#" onclick="General_pdf('+data.id+');"> <span class="text-bold"> <i class="fas fa-print"></i>&nbsp; General </span> </a> </li> </ul></div></span>';
                }
            }
        ]
    });
}

function General_pdf(id_sl) {
    let html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header' style='background-color: #3c8dbc ; color: white;'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'> <i class='far fa-file-alt info'></i> &nbsp; Solicitud || PDF</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='Buscar/Get_Solicitud_Pdf/?id="+id_sl+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_general').html(html);
    $("#pdf_contenedor_general").modal('show');
}

function Tabla_contratos() {
    $('#buscar_contratos').DataTable({
        "destroy":true,
        "autoWidth":true,
        "scrollY": 300,
        "scrollCollapse":false,
        "scrollX": true,
        "responsive":true,
        "lengthMenu":[[10, 20, 25, 50, -1], [10, 20, 25, 50, "Todos"]],
        "language":{
            "url": 'public/locales/Spanish.json'
        },
        "ajax":{
            "method":"POST",
            "url":"Buscar/Get_Contratos",
            "data":{
                'dpto':$('#departamento_ctr_th').val(),
                'f_desde':$('#fecha_inicio_ctr').val(),
                'f_hasta':$('#fecha_fin_ctr').val()
            },
            beforeSend:function () {

            },
            complete:function () {

            }
        },
        "columns":[
            {"data":"codigo","width": "7%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"remuneracion","width":"5%"},
            {"data":"fecha"},
            {"data":"fecha_inicio","width":"7%"},
            {"data":"fecha_finaliza","width":"7%"},
            {"data":"meses","width": "5%"},
            {"data":"titulo","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data":"codigo_solicitud"},
            {"data":"estado"},
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
                "targets": [13],
                "data": "estado",
                "render":function(data) {
                    if(data === 'P '){
                        return '<span class="label label-warning">PROCESO</span>';
                    }else if(data === 'R ') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A '){
                        return '<span class="label label-primary">ACEPTADA</span>';
                    }else if (data === 'E '){
                        return '<span class="label label-danger">ANULADA</span>';
                    }else if (data === 'T '){
                        return '<span class="label label-success">TERMINADA</span>';
                    }
                }
            },
            {   "targets": [14],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1" style="background-color: #F5F5F5"><li> <a href="#" onclick="GeneralContrato_pdf('+data.id+');"> <span class="text-bold"> <i class="fas fa-print"></i>&nbsp; General </span> </a> </li> </ul></div></span>';

                }
            }
        ]
    });
}

function GeneralContrato_pdf(id_ctr) {
    let html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header' style='background-color: #3c8dbc ; color: white;'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'> <i class='far fa-file-alt info'></i> &nbsp; Contrato || PDF</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +=" <iframe id='frame' height='650' width='100%' src='Buscar/Get_Constrato_Pdf/?id="+id_ctr+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_general').html(html);
    $("#pdf_contenedor_general").modal('show');
}