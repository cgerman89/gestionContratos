let inicio=null;
let finaliza=null;
$(document).ready(function () {
   console.log('cargado modulo contrato th');
    let fecha_ini=null;
    let fecha_fin=null;
   const personal_txt=$('#personal_txt');
   const id_solicitud_txt=$('#id_solicitud_txt');
   const id_departamento_txt=$('#id_departamento_txt');
   const tipo_solicitud_th_ctr=$('#tipo_solicitud_th_ctr');
   const observacion_th_ctr=$('#observacion_th_ctr');
   const n_documento_th_ctr=$('#n_documento_th_ctr');
   const aspirante_th_ctr=$('#aspirante_th_ctr');
   const puesto_dedicacion_th_ctr=$('#puesto_dedicacion_th_ctr');
   const departamento_sl_ctr_th=$('#departamento_sl_ctr_th');
   const tipo_categoria_docente_ctr=$('#tipo_categoria_docente_ctr');
   const tipo_regimen_ctr=$('#tipo_regimen_ctr');
   const nivel_docente_ctr=$('#nivel_docente_ctr');
   const dedicacion_docente_ctr=$('#dedicacion_docente_ctr');
   const rmu_docente_ctr=$('#rmu_docente_ctr');
   const rmu_admin_ctr=$('#rmu_admin_ctr');
   const puesto_administrativo_ctr=$('#puesto_administrativo_ctr');
   const gp_ocupacional_admin_ctr=$('#gp_ocupacional_admin_ctr');
   const fecha_inicio_ctr=$('#fecha_inicio_ctr');
   const fecha_fin_ctr=$('#fecha_fin_ctr');
   const meses_ctr=$('#meses_ctr');
   const btn_save_docente_ctr=$('#btn_save_docente_ctr');
   const btn_save_admin_ctr=$('#btn_save_admin_ctr');
   const btn_cerrar_md_contrato_th=$('#btn_cerrar_md_contrato_th');
   const form_cabecera_ctr=$('#form_cabecera_ctr');
   const form_ctr_docente=$('#form_ctr_docente');
   const form_ctr_admin=$('#form_ctr_admin');
   const modal_crear_contrato_th=$('#modal_crear_contrato_th');
   const panel_docente_ctr=$('#panel_docente_ctr');
   const panel_administrativo_ctr=$('#panel_administrativo_ctr');
   const tabla_lista_solicitud_contrato_th=$('#tabla_lista_solicitud_contrato_th');
   const id_denominacion_docente=$('#id_denominacion_docente');
   const id_denominacion_admin=$('#id_denominacion_admin');
   const titulo_academico_ctr=$('#titulo_academico_ctr');
   const departamento_th_ctr=$('#departamento_th_ctr');
   const departamento_ctr_th=$('#departamento_ctr_th');
   const tabla_lista_contratos=$('#tabla_lista_contratos');
   const id_contrato_txt=$('#id_contrato_txt');



   //funciones
     departamento_sl_ctr_th.select2({theme:"bootstrap"});
     departamento_ctr_th.select2({theme:"bootstrap"});
     fecha_inicio_ctr.datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true});
     fecha_fin_ctr.datepicker({format: 'yyyy-mm-dd',language:'es',autoclose:true});
     CargaComboDepartamentos_th(departamento_sl_ctr_th);
     CargaComboDepartamentos_th(departamento_ctr_th);
     CargaCombo_th(tipo_regimen_ctr,2);
     CargaCombo_th(tipo_categoria_docente_ctr,10);
     CargaCombo_th(gp_ocupacional_admin_ctr,6);

   TablaSolicitudes_th();
   TablaContratos();
  //eventos
   departamento_ctr_th.change(function () {
       TablaContratos($(this).val());
   });

   tipo_categoria_docente_ctr.change(function () {
     ComboNiveles_contrato(nivel_docente_ctr,$(this).val());
   });

   nivel_docente_ctr.change(function () {
     ComboDedicacion_contrato(dedicacion_docente_ctr,$(this).val());
   });

   gp_ocupacional_admin_ctr.change(function () {
       ListaOcupaciones(puesto_administrativo_ctr,$(this).val());
   });

   btn_cerrar_md_contrato_th.click(function (e) {
        e.preventDefault();
        limpiarFormulario();
    });

   btn_save_docente_ctr.click(function (e) {
       e.preventDefault();
       if( (form_cabecera_ctr.smkValidate()) && (form_ctr_docente.smkValidate())){
           let data={
               'id_contrato':id_contrato_txt.val(),
               'tipo':tipo_solicitud_th_ctr.val(),
               'id_personal':personal_txt.val(),
               'id_solicitud':id_solicitud_txt.val(),
               'id_regimen':tipo_regimen_ctr.val(),
               'denominacion':id_denominacion_docente.val(),
               'rmu':rmu_docente_ctr.val(),
               'fecha_inicio':fecha_inicio_ctr.val(),
               'fecha_finaliza':fecha_fin_ctr.val(),
               'id_titulo':titulo_academico_ctr.val(),
               'id_departamento':id_departamento_txt.val()
           };
           console.log('btn docente '+JSON.stringify(data));
           SaveContrato(data,function (resp){
              console.log(resp);
              if(resp.opcion === '1'){
                  tabla_lista_solicitud_contrato_th.DataTable().ajax.reload();
                  tabla_lista_contratos.DataTable().ajax.reload();
                  toastr.success(resp.mensaje,'Crear Contrato');
              }else if(resp.opcion === '2'){
                  toastr.error(resp.mensaje,'Crear Contrato');
              }
           });
       }
   });

   btn_save_admin_ctr.click(function (e) {
       e.preventDefault();
       if((form_cabecera_ctr.smkValidate())&&(form_ctr_admin.smkValidate())){
           let data={
               'id_contrato':id_contrato_txt.val(),
               'tipo':tipo_solicitud_th_ctr.val(),
               'id_personal':personal_txt.val(),
               'id_solicitud':id_solicitud_txt.val(),
               'id_regimen':tipo_regimen_ctr.val(),
               'denominacion':id_denominacion_admin.val(),
               'rmu':rmu_admin_ctr.val(),
               'fecha_inicio':fecha_inicio_ctr.val(),
               'fecha_finaliza':fecha_fin_ctr.val(),
               'id_titulo':titulo_academico_ctr.val(),
               'id_departamento':id_departamento_txt.val()
           };
           console.log('btn admin '+JSON.stringify(data));
           SaveContrato(data,function (resp){
               console.log(resp);
               if(resp.opcion === '1'){
                   tabla_lista_solicitud_contrato_th.DataTable().ajax.reload();
                   tabla_lista_contratos.DataTable().ajax.reload();
                   toastr.success(resp.mensaje,'Crear Contrato');
               }else if(resp.opcion === '2'){
                   toastr.error(resp.mensaje,'Crear Contrato');
               }
           });
       }
   });

   departamento_sl_ctr_th.change(function () {
       TablaSolicitudes_th($(this).val());
   });

   fecha_inicio_ctr.datepicker().on('changeDate', function(ev){
        fecha_ini=new Date(ev.date.getFullYear(),ev.date.getMonth(),ev.date.getDate(),0,0,0);
            if(fecha_fin!==null&&fecha_fin!=='undefined'){
                if(fecha_fin<=fecha_ini){
                    toastr.error('Fecha Finalización No Puede Ser Menor A Fecha Inicio');
                    fecha_ini=null;
                    fecha_inicio_ctr.val("");
                }else{
                    meses_ctr.val(Meses(fecha_fin,fecha_ini));
                }
            }
    });

   fecha_fin_ctr.datepicker().on("changeDate", function(ev){
            fecha_fin=new Date(ev.date.getFullYear(),ev.date.getMonth(),ev.date.getDate(),0,0,0);
            if(fecha_ini!==null&&fecha_ini!=='undefined'){
                if(fecha_fin<=fecha_ini){
                    toastr.error('Fecha Finalización No Puede Ser Menor A Fecha Inicio');
                    fecha_fin=null;
                    fecha_fin_ctr.val("");
                }else{
                    meses_ctr.val(Meses(fecha_fin,fecha_ini));
                }
            }
    });

   tabla_lista_solicitud_contrato_th.on("click","a.CrearContrato",function () {
        let datos=tabla_lista_solicitud_contrato_th.DataTable().row( $(this).parents("tr") ).data();
        if(datos!==null){
            personal_txt.val(datos.id_personal);
            id_solicitud_txt.val(datos.id_solicitud_contrato);
            id_departamento_txt.val(datos.id_departamento);
            tipo_solicitud_th_ctr.val(datos.t_contrato);
            departamento_th_ctr.val(datos.departamento);
            observacion_th_ctr.val(datos.observacion);
            n_documento_th_ctr.val(datos.cedula_aspirante);
            aspirante_th_ctr.val(datos.aspirante);
            if(datos.t_contrato==='DOCENTE') {
                puesto_dedicacion_th_ctr.val(datos.dedicacion);
            }else if(datos.t_contrato==='ADMINISTRATIVO'){
                puesto_dedicacion_th_ctr.val(datos.puesto);
            }
            if(datos.t_contrato==='DOCENTE'){
                panel_docente_ctr.prop('hidden',false);
            }else if(datos.t_contrato==='ADMINISTRATIVO'){
                panel_administrativo_ctr.prop('hidden',false);
            }
            ListarTitulos(datos.id_personal,titulo_academico_ctr);
            modal_crear_contrato_th.modal('show');
        }

   });

   tabla_lista_contratos.on("click","a.EditarContrato",function () {
       let datos=tabla_lista_contratos.DataTable().row( $(this).parents("tr") ).data();
           ListarTitulos(datos.id_personal,titulo_academico_ctr);
           DatosContrato(datos.id_contrato,function (resp) {
               if(resp!==null) {
                   id_contrato_txt.val(datos.id_contrato);
                   personal_txt.val(resp.id_personal);
                   id_solicitud_txt.val(resp.id_solicitud_contrato);
                   id_departamento_txt.val(resp.id_departamento);
                   tipo_solicitud_th_ctr.val(resp.t_contrato);
                   departamento_th_ctr.val(resp.departamento);
                   observacion_th_ctr.val(resp.observacion);
                   n_documento_th_ctr.val(resp.cedula_aspirante);
                   aspirante_th_ctr.val(resp.aspirante);
                   if(resp.t_contrato==='DOCENTE') {
                       puesto_dedicacion_th_ctr.val(resp.dedicacion);
                       DenominacionDocente(resp.id_tipo_denominacion,function (data) {
                          tipo_categoria_docente_ctr.val(data.id_categoria_docente).prop('selected','selected');
                          ComboNiveles_contrato(nivel_docente_ctr,data.id_categoria_docente);
                           setTimeout(function () {
                                nivel_docente_ctr.val(data.id_nivel_docente).prop('selected','selected');
                           },500);
                          ComboDedicacion_contrato(dedicacion_docente_ctr,data.id_nivel_docente);
                           setTimeout(function () {
                                dedicacion_docente_ctr.val(data.id_dedicacion_docente).prop('selected','selected');
                           },500);
                           RmuDocente(data.id_categoria_docente,data.id_nivel_docente,data.id_dedicacion_docente);
                       });
                   }else if(resp.t_contrato==='ADMINISTRATIVO'){
                       puesto_dedicacion_th_ctr.val(resp.puesto);
                       DenominacionAdmin(resp.id_tipo_denominacion,function (data) {
                         gp_ocupacional_admin_ctr.val(data.id_grupo_ocupacional).prop('selected','selected');
                         ListaOcupaciones(puesto_administrativo_ctr,data.id_grupo_ocupacional);
                           setTimeout(function () {
                               puesto_administrativo_ctr.val(data.id_puesto).prop('selected','selected');
                           },500);
                         RmuAdmin(data.id_grupo_ocupacional,data.id_puesto);
                       });
                   }
                   if(resp.t_contrato==='DOCENTE'){
                       panel_docente_ctr.prop('hidden',false);
                   }else if(resp.t_contrato==='ADMINISTRATIVO'){
                       panel_administrativo_ctr.prop('hidden',false);
                   }
                   setTimeout(function () {
                       titulo_academico_ctr.val(resp.id_titulo_profesional).prop('selected','selected');
                   },500);
                   tipo_regimen_ctr.val(resp.id_regimen_laboral).prop('selected','selected');
                   fecha_inicio_ctr.datepicker('update',resp.fecha_inicio);
                   fecha_fin_ctr.datepicker('update', resp.fecha_finaliza);
                   meses_ctr.val(Meses(fecha_fin_ctr.val(),fecha_inicio_ctr.val()));

               }
               modal_crear_contrato_th.modal('show');
           });


   });

   function RmuDocente(categoria,nivel,denominacion) {
       LlenarRenumeracionDocente(categoria,nivel,denominacion,function (datos) {
           if(datos!== null){
               id_denominacion_docente.val(datos.id_denominacion_docente);
               rmu_docente_ctr.val(datos.rmu);
           }else{
               id_denominacion_docente.val('');
               rmu_docente_ctr.val('');
           }
       });
   }

   function RmuAdmin(gp_ocupacional,puesto){
       LLenarRemneracionAdmin(gp_ocupacional,puesto,function (datos) {
           if(datos!== null) {
               id_denominacion_admin.val(datos.id_denominacion_admin);
               rmu_admin_ctr.val(datos.rmu);
           }else{
               id_denominacion_admin.val('');
               rmu_admin_ctr.val('');
           }
       })
   }

   form_ctr_docente.on("change","select",function () {
       console.log('se hizo cliccc form docente');
       RmuDocente(tipo_categoria_docente_ctr.val(),nivel_docente_ctr.val(),dedicacion_docente_ctr.val());
   });

   form_ctr_admin.on("change","select",function () {
       console.log('se hizo cliccc admin');
       RmuAdmin(gp_ocupacional_admin_ctr.val(),puesto_administrativo_ctr.val());
   });

   function limpiarFormulario() {
        fecha_inicio_ctr.datepicker('update', '');
        fecha_fin_ctr.datepicker('update', '');
        form_cabecera_ctr.smkClear();
        form_cabecera_ctr[0].reset();
        form_ctr_docente.smkClear();
        form_ctr_docente[0].reset();
        form_ctr_admin.smkClear();
        form_ctr_admin[0].reset();
        panel_docente_ctr.prop('hidden',true);
        panel_administrativo_ctr.prop('hidden',true);
        fecha_ini=null;
        fecha_fin=null;
   }

});

//funciones
function SaveContrato(datos,callback){
    $.ajax({
        url:'cTalento_humano/CrearContrato',
        type:'POST',
        dataType:'json',
        data:datos,
        beforeSend:function () {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        },
        success:function(response){
            callback(response);
        },
        complete:function () {
            swal.closeModal();
        },
        error:function() {
            console.log('Error al enviar la peticion crear contrato ');
        }
    });
}

function DatosContrato(id_contrato,callback){
    $.ajax({
        url:"cTalento_humano/EditarContrato",
        type:'POST',
        dataType:'json',
        data:{'id_contrato':id_contrato},
        beforeSend: function( xhr ) {
            swal({title:'espere...',allowOutsideClick:false,allowEnterKey:false});
            swal.showLoading();
        }
    }).done(function( data ){
        callback(data);
    }).always(function() {
        swal.closeModal();
    });
}

function ListarTitulos(id_personal,combo){
   $(combo).find('option').remove();
   $(combo).append('<option value="">seleccione</option>');
   $.post('Campos/ListarTitulos',{'id_personal':id_personal},function (datos, estado){
       if (estado === 'success')$.each(datos, function (index, value) {
           $(combo).append('<option value='+value.id_inst_formal+'>'+value.titulo+'</option>');
       });
   },'json');
}

function CargaComboDepartamentos_th(combo) {
    $.post('cTalento_humano/GetListadoDepartamentos',function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.iddepartamento+'>'+value.nombre+'</option>');
        });
    },'json');
}

function CargaCombo_th(combo,id) {
    $.post('Campos/Tipo2',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function ComboNiveles_contrato(combo,id) {
    $(combo).find('option').remove();
    $(combo).append('<option value="">seleccione</option>');
    $.post('cTalento_humano/ListaNiveles',{'categoria':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function ComboDedicacion_contrato(combo,id) {
    $(combo).find('option').remove();
    $(combo).append('<option value="">Seleccione</option>');
    $.post('cTalento_humano/ListaDedicacion',{'dedicacion':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function LlenarRenumeracionDocente(categoria,nivel,dedicacion,callback){
   $.post('cTalento_humano/ListaRemuneracionDocente',{'catetoria':categoria,'nivel':nivel,'dedicacion':dedicacion},function (datos,estado,xhr) {
       if(estado ==='success'){
           callback(datos);
       }else if(estado ==='error'){
         console.log("error"+xhr);
       }
   },'json');
}

function DenominacionDocente(id_denominacion,callback) {
    $.ajax({
        url:"cTalento_humano/DenominacionDocente",
        type:'POST',
        dataType:'json',
        data:{'id_denominacion':id_denominacion}
    }).done(function( data ){
        callback(data);
    }).always(function() {
        console.log('fin peticion Denominacion docente');
    });
}

function DenominacionAdmin(id_denominacion,callback) {
    $.ajax({
        url:"cTalento_humano/DenominacionAdmin",
        type:'POST',
        dataType:'json',
        data:{'id_denominacion':id_denominacion}
    }).done(function( data ){
        callback(data);
    }).always(function() {
        console.log('fin peticion Denominacion admin');
    });
}

function ListaOcupaciones(combo,id_grupo){
   $(combo).find('option').remove();
   $(combo).append('<option value="">seleccione</option>');
   $.post('cTalento_humano/ListaOcupacion',{'grupo_ocupacion':id_grupo},function (datos,estado,xhr) {
       if(estado ==='success')$.each(datos, function (index, value) {
           $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
       });
   },'json');
}

function LLenarRemneracionAdmin(grupo,puesto,callback) {
    $.post('cTalento_humano/ListaRemuneracionAdmin',{'grupo_ocupacion':grupo,'puesto':puesto},function (datos,estado,xhr) {
        if(estado ==='success'){
            callback(datos);
        }else if(estado ==='error'){
            console.log("error"+xhr);
        }
    },'json');
}

function Meses(fecha_final,fecha_inicial) {
  inicio=moment(fecha_inicial);
  finaliza=moment(fecha_final);
  if((inicio!==null&&inicio!=='undefined')&& (finaliza!==null&&finaliza!=='undefined')){
      return finaliza.diff(inicio,'month');
  }
}

function Generar_hoja_vida(id_persona) {
    let html ="<div class='modal-dialog'>";
    html +=" <div class='modal-content'>";
    html +=" <div class='modal-header'>";
    html +=" <button type='button'  id='btn_cerrar_md_banco' name='btn_cerrar_md_banco' class='close' data-dismiss='modal'>&times;</button>";
    html +=" <h4 class='panel-title'>Hoja de Vida</h4>";
    html +=" </div>";
    html +=" <div class='modal-body'>";
    html +="<iframe id='frame' height='650' width='100%' src='cTalento_humano/Hoja_Vida/?id="+id_persona+"'  frameborder='0'></iframe>";
    html +=" </div>";
    html +=" </div>";
    html +=" </div>";
    $('#pdf_contenedor_hv').html(html);
    $("#pdf_contenedor_hv").modal('show');
}

function TablaSolicitudes_th(id_dpto) {
   $('#tabla_lista_solicitud_contrato_th').DataTable({
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
            "url":"cTalento_humano/SolicitudContrato",
            "data":{'id_dpto':id_dpto},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"codigo","width":"9%"},
            {"data":null,"width":"22%",'orderable': false},
            {"data":"departamento","width":"16%",'orderable': false},
            {"data":"cordinador","width":"18%"},
            {"data":"fecha_solicitud","width":"12%"},
            {"data":"t_contrato","width":"9%"},
            {"data":null},
            {"data":"observacion"},
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
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <i  class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida</a></li><li><a href="#" onclick="TablaProcesoSolicitud('+data.id_solicitud_contrato+')" data-toggle="modal" data-target="#md_solicitud_proceso" > <i class="fa fa-gears"></i> Ver Proceso</a></li><li><a href="#" class="CrearContrato"><i class="fa fa-file-o" aria-hidden="true"></i> Nuevo Contrato</a></li>  </ul></div></span>';
                }
            }
        ]
    });
}

function TablaProcesoSolicitud(id_solicitud){
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
           "url":"cTalento_humano/ProcesoSolicitud",
           "data":{'id_solicitud':id_solicitud},
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

function TablaContratos(id_dpto){
    $('#tabla_lista_contratos').DataTable({
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
            "url":"cTalento_humano/ListarContratos",
            "data":{'id_dpto':id_dpto},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"codigo","width":"9%"},
            {"data":null,"width":"20%"},
            {"data":"modalidad_laboral","width":"10%"},
            {"data":"tipo","width":"9%"},
            {"data":"deominacion","width":"20%"},
            {"data":"departamento","width":"9%"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {
                "targets": [1],
                "render":function(data) {
                    return " <span> <i class='fa fa-user'></i>  &nbsp;"+ data.aspirante+" <br><i class='fa fa-id-card'></i> &nbsp;"+data.cedula_aspirante+ "  </span>";
                }
            },
            {   "targets": [6],
                "render": function(data,row) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" onClick="Generar_hoja_vida('+data.id_personal+')"> <span class="text-bold"> <i  class="fa fa-file-pdf-o" aria-hidden="true"></i> Hoja de vida </span></a></li><li><a href="#" onclick="TablaProcesoContrato('+data.id_contrato+')" data-toggle="modal" data-target="#md_contrato_proceso" ><span class="text-bold"> <i class="fa fa-gears"></i> Ver Proceso </span></a></li><li><a href="#" class="EditarContrato"><span class="text-bold"> <i class="fa fa-edit" aria-hidden="true"></i> Modificar Contrato </span></a></li>  </ul></div></span>';
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
