$(document).ready(function () {
  console.log('modulo text cargado..');

  const btn_agregar_texto=$('#btn_agregar_texto');
  const md_agregar_texto_ctr=$('#md_agregar_texto_ctr');
  const txt_texto=$('#txt_texto');
  const btn_guardar_texto=$('#btn_guardar_texto');
  const tipo_ctr=$('#tipo_ctr');
  const denominacion_ctr=$('#denominacion_ctr');
  const btn_cerrar_md_texto=$('#btn_cerrar_md_texto');
  const tipo_ctr_2 = $('#tipo_ctr_2');
  const tbl_texto = $('#tbl_texto');


  CargaCombo(tipo_ctr,1);
  CargaCombo(tipo_ctr_2,1);
  txt_texto.wysihtml5();
  Tabla_Texto();

  tipo_ctr.change(function () {
     LlenarDenominacion($(this).val(),denominacion_ctr);
  });
  
  tipo_ctr_2.change(function () {
      if($(this).val()!=='')
         Tabla_Texto($(this).val());
  });
  
  btn_agregar_texto.click(function (e) {
     e.preventDefault();
     md_agregar_texto_ctr.modal('show');
  });

  btn_guardar_texto.click(function (e) {
      e.preventDefault();
      if($('#form_texto').smkValidate()){
          Save(function (data) {
              console.log(data);
              if (data == 1) {
                  tbl_texto.DataTable().ajax.reload();
                  toastr.success('Se Guardo Correctamente !!! ');
              }else if( data == 2) {
                  toastr.error('Error No se puede duplicar registro');
              }else if( data == 0){
                  toastr.error('Error Al Guardar ');
              }
          });
      }
  });

  btn_cerrar_md_texto.click(function (e) {
        e.preventDefault();
        $('#form_texto')[0].reset();
  });

  tbl_texto.on("click","a.EditarTexto",function () {
      let datos=tbl_texto.DataTable().row( $(this).parents("tr") ).data();
      //console.log(datos);
      $('#id_texto').val(datos.id_texto);
      tipo_ctr.val(datos.id_tipo).trigger('change');
      setTimeout(function () {
          denominacion_ctr.val(datos.id_denominacion).prop('selected','selected').trigger('change');
      },500);
      $('iframe').contents().find('.wysihtml5-editor').html(datos.texto);
      md_agregar_texto_ctr.modal('show');
  });
  

});

function CargaCombo(combo,id) {
    $.post('Campos/Tipo2',{'id':id},function (datos, estado, xhr) {
        if (estado === 'success') $.each(datos, function (index, value) {
            $(combo).append('<option value='+value.idtipo+'>'+value.nombre+'</option>');
        });
    },'json');
}

function LlenarDenominacion(id_tipo,combo) {
    $(combo).find('option').remove();
    $(combo).append('<option value="">seleccione</option>');
      $.post('Contrato_Text/Denominacion',{'id_tipo':id_tipo},function (datos, estado) {
          if (estado === 'success') $.each(datos, function (index, value) {
              $(combo).append('<option value='+value.id+'>'+value.denominacion+'</option>');
          });
      },'json');
}

function Save(callback) {
  $.ajax({
      url:'Contrato_Text/SaveTexto',
      type:'POST',
      data:{'id_texto':$('#id_texto').val(),'id_tipo':$('#tipo_ctr').val(),'id_denominacion':$('#denominacion_ctr').val(),'texto':$('#txt_texto').val()},
      dataTypes:'json',
      beforeSend:function () {
          swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
          swal.showLoading();
      },
      success: function (data){
          callback(data);
      },
      complete:function () {
          swal.closeModal();
      },
      error: function () {
          console.error('error en la peticion crear aspirante ');
      }
  });
}

function EliminarTexto(id_texto) {
    swal({
        title:" Eliminar Registro?",
        text:" Confirme para Eliminar el registro de texto!!",
        type:"warning",
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function () {
      console.log(id_texto);
      $.post('Contrato_Text/Eliminar',{'id_texto':id_texto},function (data) {
          console.log(data);
          if(data === 1){
              $('#tbl_texto').DataTable().ajax.reload();
              toastr.info('Se Elimino Correctamente');
          }else {
              toastr.error('Error Al Eliminar Registro');
          }

      },'json');
    },function (dismiss) { }
    );
}

function Tabla_Texto(id_tipo) {
    $('#tbl_texto').DataTable({
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
            "url":"Contrato_Text/GetAllTexto",
            "data":{'id_tipo':id_tipo},
            beforeSend:function () {
                swal({title: 'espere...', allowOutsideClick: false, allowEnterKey: false});
                swal.showLoading();
            },
            complete:function () {
                swal.closeModal();
            }
        },
        "columns":[
            {"data":"deominacion","width":"50%"},
            {"data":"fecha"},
            {"data":null,'orderable': false, 'searchable': false,"width": "9%"}
        ],
        "columnDefs": [
            {   "targets": [2],
                "render": function(data) {
                    return '<span class="pull-left"><div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-list"></i><span class="caret"></span></button><ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1"><li><a href="#" class="EditarTexto" > <span class="text-bold"> <i class="far fa-edit"></i> &nbsp; EDITAR TEXTO </span></a></li>   <li> <a href="#"  onclick="EliminarTexto('+data.id_texto+')" > <span class="text-bold"> <i class="fas fa-trash-alt"></i> &nbsp;  ELIMINAR</span> </a> </li> </ul></div></span>';
                }
            }
        ],
    });
}