$(document).ready(function () {
   console.log('pagina opciones contrato th cargada');
   Tabla_Solicitudes_th();
   CargaComboDepartamentos_th('#departamento_sl_ctr_th');
   CargaCombo_th('#tipo_solicitud_sl_ctr_th',66);
   $('#departamento_sl_ctr_th').select2({theme:"bootstrap"});
   $('#tipo_solicitud_sl_ctr_th').select2({theme:"bootstrap"});

  //eventos
   $('#btn_md_lista_solicitud_th').click(function (e) {
       e.preventDefault();
       $('#modal_lista_solicitud_th').modal('show');
   });
   $('#tipo_solicitud_sl_ctr_th').change(function (){
      if($(this).val() !== ''){
          Tabla_Solicitudes_th($('#departamento_sl_ctr_th').val(),$(this).val());
      }

   });
    $('#tabla_lista_solicitud_contrato_th').on("click","button.selecion_solicitud_th",function () {
        var data = $('#tabla_lista_solicitud_contrato_th').DataTable().row( $(this).parents("tr") ).data();
        swal({
            title: 'Seleccionar a ?',
            html: "<span>"+data.aspirante+"<br>"+data.cedula_aspirante +"</span>",
            type: 'question',
            allowOutsideClick: false,
            allowEnterKey: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then(function () {
            PasarDatos(data);
            $('#tabs_th a[href="#crear_contrato_th"]').tab('show');
        },function (dismiss){});

    });
});

//funciones
function PasarDatos(data) {
   $('#id_aspirante_th_ctr').val(data.id_personal);
   $('#tipo_contrato_th_ctr').val(data.tipo_solicitud);
   $('#aspirante_th_ctr').val(data.aspirante);
   $('#n_documento_th_ctr').val(data.cedula_aspirante);
   $('#observacion_th_ctr').val(data.observacion);
   if(data.tipo_solicitud ==='ADMINISTRATIVO'){
       $('#puesto_dedicacion_th_ctr').val(data.puesto);
   }else{
       $('#puesto_dedicacion_th_ctr').val(data.dedicacion);
   }

}


function Tabla_Solicitudes_th(dpto,tipo_solicitud) {
    var tabla_solicitudes_th=$('#tabla_lista_solicitud_contrato_th').DataTable({
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
            "url":"cTalento_humano/GetSolicitud_Contrato_th",
            "data":{'dpto':dpto,'tipo':tipo_solicitud},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":null,"width":"15%",'orderable': false},
            {"data":"departamento","width":"16%",'orderable': false},
            {"data":"cordinador","width":"18%"},
            {"data":"fecha_solicitud","width":"15%"},
            {"data":"tipo_solicitud","width":"15%"},
            {"data":"categoria","width":"15%"},
            {"data":null},
            {"data":"observacion"},
            {"data":"estado","width": "9%"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [0],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },
            {
                "targets": [6],
                "render":function(data) {
                    if(data.tipo_solicitud === 'ADMINISTRATIVO'){
                        return " <span>"+ data.puesto+"</span>";
                    }else if(data.tipo_solicitud === 'DOCENTE'){
                        return " <span>"+ data.dedicacion+"</span>";
                    }

                }
            },
            {   "targets": [8],
                "data": "estado",
                "render": function(data, type, full) {
                    if(data === 'P'){
                        return '<span class="label label-warning">PROCESO</span>';
                    }else if(data === 'R') {
                        return '<span class="label label-danger">RECHAZADA</span>';
                    }else if (data === 'A'){
                        return '<span class="label label-success">ACEPTADA</span>';
                    }
                }
            },
            {   "targets": [9],
                "render": function(data, type, row) {
                      return "<button type='button' class='selecion_solicitud_th btn btn-primary'   data-toggle='tooltip' data-placement='bottom' title='seleccionar solicitud'> <i class='fa fa-check-square-o'></i></button>";
                }
            }
        ]
    });
}

function CargaComboDepartamentos_th(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaCombo_th(combo,id) {
    $.post('Campos/Tipo',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}